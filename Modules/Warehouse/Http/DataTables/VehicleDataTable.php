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

class VehicleDataTable extends DataTable
{

    public $table_id = 'vehicle_table';
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
                    ->orWhereHas('color', function($query) use($keyword) {
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

            ->orderColumn('vin', function ($query, $order) {
                $query->orderBy('vin', $order);
            })
            ->orderColumn('color', function ($query, $order) {
                $query->join('colors', 'vehicles.color_id', '=', 'colors.id')
                    ->orderBy('colors.name', $order);

            })
            ->orderColumn('port', function ($query, $order) {
                $query->join('ports', 'vehicles.port_id', '=', 'ports.id')
                    ->orderBy('ports.name', $order);
            })

            ->editColumn('id', function (Vehicle $model) {
                return '#'.$model->id;
            })
            ->editColumn('vehicle', function (Vehicle $model) {
                return $model->name;
            })
            ->editColumn('color', function (Vehicle $model) {
                return $model->color->name;
            })
            ->editColumn('customer', function (Vehicle $model) {
                return $model->client->user->name."(".$model->client->contact_full_name.")" ;
            })
            ->editColumn('port', function (Vehicle $model) {
                return $model->port->name;
            })
            ->editColumn('photos', function (Vehicle $model) {
                return 0;
            })

            ->editColumn('created_at', function (Vehicle $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('row_link', function (Vehicle $model) {
                // Define the URL for each row (e.g., view or edit page)
                $url = route('vehicles.edit', $model->id); // Update the route as needed

                // Wrap the name in an anchor tag
                return '<a class="clickLink" href="'.$url.'">'.$model->name.'</a>';
            })
            ->addColumn('action', function (Vehicle $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.vehicles.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
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
        $query = $model->newQuery();

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
                'paging' => true,
                'lengthChange' => true,
                'pageLength' => 10,
                'pagingType' => 'full_numbers',
                'buttons' => [
                    ...$this->buttonsExport(),
                ],
                'colReorder' => true, // Enable column reorder
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
            Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('vehicle')->title(__('warehouse::view.name')),
            Column::make('vin')->title(__('warehouse::view.vin')),
            Column::make('color')->title(__('warehouse::view.color')),
            Column::make('customer')->title(__('warehouse::view.customer company (Full Name)')),
            Column::make('photos')->title(__('warehouse::view.photos')),
            Column::make('port')->title(__('warehouse::view.port')),
            Column::make('created_at')->title(__('view.created_at')),
            Column::computed('action')
                ->title(__('view.action'))
                ->addClass('text-center not-export')
                ->responsivePriority(-1)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Truck_Companies_'.date('YmdHis');
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
