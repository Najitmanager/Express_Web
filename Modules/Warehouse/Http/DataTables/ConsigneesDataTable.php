<?php

namespace Modules\Warehouse\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Warehouse\Entities\Consignee;
use Modules\Warehouse\Entities\Port;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Illuminate\Http\Request;

use Modules\Warehouse\Http\Filter\PortFilter;

class ConsigneesDataTable extends DataTable
{

    public $table_id = 'consignees_table';
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
            ->rawColumns(['action', 'select','consignee','address','country','city','phone'])
            ->filterColumn('consignee', function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->filterColumn('city', function($query, $keyword) {
                $query->where('city', 'LIKE', "%$keyword%");
            })
            ->filterColumn('country', function($query, $keyword) {
                $query->where('country_id', $keyword);
            })

            ->orderColumn('consignee', function ($query, $order) {
                $query->orderBy('name', $order);
            })
            ->orderColumn('country', function ($query, $order) {
                $query->orderBy('country_id', $order);
            })
            ->orderColumn('city', function ($query, $order) {
                $query->orderBy('city', $order);
            })

            ->addColumn('select', function (Consignee $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');
                return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('id', function (Consignee $model) {
                return '#'.$model->id;
            })
            ->editColumn('country', function (Consignee $model) {
                return $model->country->name;
            })
            ->addColumn('active', function (Consignee $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.consignees.columns.checkbox', ['model' => $model, 'active' => $model->active, 'ifHide' => $model->id == 0]);
            })
            ->editColumn('created_at', function (Consignee $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('row_link', function (Consignee $model) {
                // Define the URL for each row (e.g., view or edit page)
                $url = route('consignees.edit', $model->id); // Update the route as needed

                // Wrap the name in an anchor tag
                return '<a href="'.$url.'">'.$model->name.'</a>';
            })
            ->addColumn('action', function (Consignee $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.consignees.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Port  $model
     *
     * @return Port
     */
    public function query(Consignee $model, Request $request)
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
            ->responsive()
            ->autoWidth(false)
            ->parameters([
                'scrollX' => true,
                'dom' => 'Bfrtip',
                'bDestroy' => true,
                'language' => ['url' => "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/$lang.json"],
                'buttons' => [
                    ...$this->buttonsExport(),
                ],
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
            Column::computed('select')
                ->title('
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input checkbox-all-rows" type="checkbox">
                        </div>
                    ')
                ->responsivePriority(-1)
                ->addClass('not-export')
                ->width(50),
            Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('name')->title(__('warehouse::view.name')),
            Column::make('address')->title(__('warehouse::view.address')),
            Column::make('country')->title(__('warehouse::view.country')),
            Column::make('city')->title(__('warehouse::view.city')),
            Column::make('phone')->title(__('warehouse::view.phone')),
            Column::make('active')->title(__('port::view.active')),
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
        return 'Consignees_'.date('YmdHis');
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
