<?php

namespace Modules\Warehouse\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Warehouse\Entities\Port;
use Modules\Warehouse\Entities\TruckCompany;
use Modules\Warehouse\Entities\Dock;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Illuminate\Http\Request;

use Modules\Warehouse\Http\Filter\PortFilter;

class LoadPlanDataTable extends DataTable
{

    public $table_id = 'dock_table';
    public $btn_exports = [
        'excel',
        'print',
        'pdf'
    ];
    public $filters = [ 'created_at' , 'name' ];
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
            ->rawColumns(['action','dock','booking', 'VTitle'])
            ->filterColumn('dock', function($query, $keyword) {
                $query->where('document_no', 'LIKE', "%$keyword%")
                    ->orWhereHas('booking', function($query) use($keyword) {
                        $query->where('booking_no', 'LIKE', "%$keyword%");
                    })
                    ->orWhere('container_no', 'LIKE', "%$keyword%");
            })



            ->orderColumn('dock', function ($query, $order) {
                $query->orderBy('id', $order);
            })

            ->editColumn('dock', function (Dock $model) {
                return $model->document_no;
            })
            ->editColumn('VTitle', function (Dock $model) {
                return $model->VTitle;
            })
            ->editColumn('booking', function (Dock $model) {
                return optional($model->booking)->booking_no;
            })
            ->editColumn('container_no', function (Dock $model) {
                $url = optional($model->carrier)->trackin_url; // Update the route as needed

                if ($url){

                    return '<a  href="'.$url.'">'.$model->container_no.'</a>';
                }else{
                    return $model->container_no;
                }
            })
            ->editColumn('customer', function (Dock $model) {
                return optional($model->client)->user->name."\n". optional($model->port)->name;
            })
            ->editColumn('loading_date', function (Dock $model) {
                return $model->loading_date;
            })
            ->editColumn('dates', function (Dock $model) {
                return "DD: ".$model->departure_date."\n".'GD: '.$model->in_gate_date ;
            })
            ->editColumn('messages', function (Dock $model) {
                return '';
            })
            ->editColumn('vehicles', function (Dock $model) {
                return $model->vehicles->count();
            })


            ->editColumn('photos', function (Dock $model) {
                return $model->total_photos_no;
            })

            ->editColumn('created_at', function (Dock $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })
            ->addColumn('row_link', function (Dock $model) {
                // Define the URL for each row (e.g., view or edit page)
                $url = route('docks.show', $model->id); // Update the route as needed

                // Wrap the name in an anchor tag
                return '<a class="clickLink" href="'.$url.'">'.$model->name.'</a>';
            })
            ->addColumn('action', function (Dock $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.docks.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Port  $model
     *
     * @return Port
     */
    public function query(Dock $model, Request $request)
    {
        $query = $model->where('type',Dock::DOCK)->newQuery();

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
            ->orderBy(0)
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
            // Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('dock')->title(__('warehouse::view.document_no')),
            Column::make('booking')->title(__('warehouse::view.booking_no')),
            Column::make('customer')->title(__('warehouse::view.customerName Port')),
            Column::make('vehicles')->title(__('warehouse::view.vehicles')),
            Column::make('port')->title(__('warehouse::view.port')),
            Column::make('dates')->title(__('warehouse::view.DD GD')),
            Column::make('messages')->title(__('warehouse::view.messages unread')),
            Column::make('photos')->title(__('warehouse::view.photos')),
            Column::make('VTitle')->title(__('warehouse::view.VTitle')),
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
        return 'DockReceipt_'.date('YmdHis');
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
