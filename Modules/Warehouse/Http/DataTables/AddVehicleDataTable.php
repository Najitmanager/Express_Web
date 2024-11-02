<?php

namespace Modules\Warehouse\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Warehouse\Entities\Port;
use Modules\Warehouse\Entities\TruckCompany;
use Modules\Warehouse\Entities\Vehicle;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Illuminate\Http\Request;

use Modules\Warehouse\Http\Filter\PortFilter;

class AddVehicleDataTable extends DataTable
{

    public $table_id = 'add_vehicle_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['country', 'created_at' , 'name' ];
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->rawColumns(['action', 'select','vehicle','vin','color','customer', 'port'])
            ->filterColumn('vehicle', function($query, $keyword) {
                $query->where('vin', 'LIKE', "%$keyword%")
                    ->orWhereHas('port', function($query) use($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    })
                    ->orWhereHas('customer', function($query) use($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    })
                    ->orWhereHas('make', function($query) use($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    })
                    ->orWhereHas('model', function($query) use($keyword) {
                        $query->where('name', 'LIKE', "%$keyword%");
                    })
                    ->orWhere('year', 'LIKE', "%$keyword%");
            })



            ->orderColumn('vehicle', function ($query, $order) {
                $query->orderBy('id', $order);
            })


            ->editColumn('vehicle', function (Vehicle $model) {
                return $model->name ." / \n" . $model->vin;
            })

            ->editColumn('color', function (Vehicle $model) {
                return optional($model->color)->name;
            })
            ->editColumn('port', function (Vehicle $model) {
                return optional($model->port)->name;
            })
            ->editColumn('title', function (Vehicle $model) {
                if ($model->workflow && $model->workflow->title_number){
                    return '<i class="fa-solid fa-square-check text-success"></i>';
                }else{
                    return '<i class="fa-solid fa-square-check text-danger"></i>';

                }
            })
            ->editColumn('key', function (Vehicle $model) {
                if ($model->workflow && count($model->workflow->getMedia('keys'))){
                    return '<i class="fa-solid fa-square-check text-success"></i>';
                }else{
                    return '<i class="fa-solid fa-square-check text-danger"></i>';

                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Port  $model
     *
     * @return Port
     */
    public function query(Vehicle $model, Request $request)
    {
        $query = $model->where('branch_id',app('hook')->get('warehouse')->id)->newQuery();

        // class filter for user only
        $user_filter = new PortFilter($query, $request);

        $query = $user_filter->filterBy($this->filters);

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $lang = \LaravelLocalization::getCurrentLocale();
        $lang = get_locale_name_by_code($lang, $lang);

        return $this->builder()
            ->setTableId($this->table_id)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->stateSave(true)
            ->orderBy(1)
            ->responsive(true)
            ->autoWidth(true)
            ->parameters([
                'scrollX' => true,
                'dom' => 'Bfrtip',
                'bDestroy' => true,
                'language' => ['url' => "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/$lang.json"],
                'dom' => '<"pagination-info-wrapper"<"info"i><"pagination"p>><"table-wrapper"t>',
                'paging' => false,
                'lengthChange' => true,
                'pageLength' => 100,
                'pagingType' => 'full_numbers',

                'colReorder' => false, // Enable column reorder
            ])
            ->addTableClass('align-middle table-row-dashed fs-6 gy-5');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('vehicle')->title(__('warehouse::view.name')),
            Column::make('color')->title(__('warehouse::view.color')),
            Column::make('title')->title(__('warehouse::view.title')),
            Column::make('key')->title(__('warehouse::view.key')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Vehicles_'.date('YmdHis');
    }


    /**
     * Transformer buttons export.
     *
     * @return array
     */
    protected function buttonsExport()
    {
        $btns = [];
        foreach($this->btn_exports as $btn) {
            $btns[] = [
                'extend' => $btn,
                'exportOptions' => [
                    'columns' => 'th:not(.not-export)'
                ]
            ];
        }
        return $btns;
    }
}
