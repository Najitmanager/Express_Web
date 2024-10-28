<?php

namespace Modules\Warehouse\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Warehouse\Http\Filter\PortFilter;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Modules\Cargo\Entities\Client;
use Illuminate\Http\Request;
use Modules\Cargo\Http\Filter\ClientFilter;

class CustomersDataTable extends DataTable
{

    public $table_id = 'clients';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = ['branch_id','name', 'created_at'];
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
            ->rawColumns(['action', 'select','name'])

            ->filterColumn('customer', function($query, $keyword) {
                $query->whereHas('user',function($q) use($keyword){
                    $q->where('name','like','%'.$keyword.'%')
                    ->orWhere('email','like','%'.$keyword.'%');
                })
                    ->orWhere('address', 'LIKE', "%$keyword%")
                    ->orWhere('phones', 'LIKE', "%$keyword%")
                    ->orWhere('contact_full_name', 'LIKE', "%$keyword%");
            })

            ->filterColumn('country', function($query, $keyword) {
                $query->where('country_id', $keyword);
            })

            ->orderColumn('customer', function ($query, $order) {
                $query->join('users', 'clients.user_id', '=', 'users.id')
                    ->orderBy('users.name', $order);
            })
            ->orderColumn('country', function ($query, $order) {
                $query->orderBy('country_id', $order);
            })
            ->orderColumn('email', function ($query, $order) {
                $query->orderBy('email', $order);
            })
            ->orderColumn('contact_full_name', function ($query, $order) {
                $query->orderBy('contact_full_name', $order);
            })
            ->orderColumn('total_vehicles', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->orderColumn('new', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->orderColumn('in_process', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->orderColumn('shipped', function ($query, $order) {
                $query->orderBy('id', $order);
            })

            // ->addColumn('select', function (Client $model) {
            //     $adminTheme = env('ADMIN_THEME', 'adminLte');
            //     return view($adminTheme.'.components.modules.datatable.columns.checkbox', ['model' => $model, 'ifHide' => $model->id == 0]);
            // })
//            ->editColumn('id', function (Client $model) {
//                return '#'.$model->id;
//            })
            ->editColumn('country', function (Client $model) {
                return $model->country->name;
            })
            ->editColumn('email', function (Client $model) {
                return $model->user->email;
            })
            ->addColumn('customer', function (Client $model) {
                return $model->user->name;
            })
            ->editColumn('total_vehicles', function (Client $model) {
                return 0;
            })
            ->editColumn('new', function (Client $model) {
                return 0;
            })
            ->editColumn('in_process', function (Client $model) {
                return 0;
            })
            ->editColumn('shipped', function (Client $model) {
                return 0;
            })
            ->editColumn('address', function (Client $model) {
                $address = trans('warehouse::view.address'). ": " . $model->address . PHP_EOL
                    . trans('warehouse::view.city') . ": " . $model->city . PHP_EOL
                    . trans('warehouse::view.state') . ": " . $model->state . PHP_EOL
                    . trans('warehouse::view.zip') . ": " . $model->zip . PHP_EOL;
                return $address;
            })
            ->addColumn('active', function (Client $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.customers.columns.checkbox', ['model' => $model->user, 'active' => $model->user->active, 'ifHide' => $model->user->id == 0]);
            })
            ->editColumn('created_at', function (Client $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('row_link', function (Client $model) {
                // Define the URL for each row (e.g., view or edit page)
                $url = route('customers.edit', $model->id); // Update the route as needed

                // Wrap the name in an anchor tag
                return '<a class="clickLink" href="'.$url.'">'.$model->name.'</a>';
            })
            ->addColumn('action', function (Client $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.customers.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Client  $model
     *
     * @return Client
     */
    public function query(Client $model, Request $request)
    {
        $query = $model->getClients($model)->newQuery();

        // class filter for user only
        $client_filter = new PortFilter($query, $request);

        $query = $client_filter->filterBy($this->filters);

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
            // Column::computed('select')
            //     ->title('
            //             <div class="form-check form-check-sm form-check-custom form-check-solid">
            //                 <input class="form-check-input checkbox-all-rows" type="checkbox">
            //             </div>
            //         ')
            //     ->responsivePriority(-1)
            //     ->addClass('not-export')
            //     ->width(50),
//            Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('customer')->title(__('warehouse::view.company_name')),
            Column::make('contact_full_name')->title(__('warehouse::view.contact_full_name')),
            Column::make('phones')->title(__('warehouse::view.phones')),
            Column::make('email')->title(__('warehouse::view.email')),
            Column::make('country')->title(__('warehouse::view.country')),
//            Column::make('address')->title(__('warehouse::view.address')),
            Column::make('total_vehicles')->title(__('warehouse::view.total_vehicles')),
            Column::make('new')->title(__('warehouse::view.new')),
            Column::make('in_process')->title(__('warehouse::view.in_process')),
            Column::make('shipped')->title(__('warehouse::view.shipped')),
            Column::make('active')->title(__('warehouse::view.active')),
//            Column::make('created_at')->title(__('view.created_at')),
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
        return 'clients_'.date('YmdHis');
    }


    /**
     * Transformer buttons export.
     *
     * @return string
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
