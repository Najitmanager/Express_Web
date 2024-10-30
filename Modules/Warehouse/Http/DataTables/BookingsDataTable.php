<?php

namespace Modules\Warehouse\Http\DataTables;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Warehouse\Entities\Port;
use Modules\Warehouse\Entities\Booking;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Illuminate\Http\Request;

use Modules\Warehouse\Http\Filter\PortFilter;

class BookingsDataTable extends DataTable
{

    public $table_id = 'bookings_table';
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
            ->rawColumns(['action','booking','booking_date','closed_on'])
            ->filterColumn('booking', function($query, $keyword) {
                $query->where('booking_no', 'LIKE', "%$keyword%");
            })

            ->orderColumn('booking', function ($query, $order) {
                $query->orderBy('booking_no', $order);
            })

            ->editColumn('load_plans', function (Booking $model) {
                return 0;
            })
            ->editColumn('booking', function (Booking $model) {
                return $model->name_icon;
            })
            ->editColumn('containers', function (Booking $model) {
                return 0;
            })
            ->editColumn('attachments', function (Booking $model) {
                return 0;
            })

            ->editColumn('created_at', function (Booking $model) {
                return date('d M, Y H:i', strtotime($model->created_at));
            })

            ->addColumn('action', function (Booking $model) {
                $adminTheme = env('ADMIN_THEME', 'adminLte');return view('warehouse::'.$adminTheme.'.pages.bookings.columns.actions', ['model' => $model, 'table_id' => $this->table_id]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Port  $model
     *
     * @return Port
     */
    public function query(Booking $model, Request $request)
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
            // Column::computed('select')
            //     ->title('
            //             <div class="form-check form-check-sm form-check-custom form-check-solid">
            //                 <input class="form-check-input checkbox-all-rows" type="checkbox">
            //             </div>
            //         ')
            //     ->responsivePriority(-1)
            //     ->addClass('not-export')
            //     ->width(50),
            // Column::make('id')->title(__('warehouse::view.table.id'))->width(50),
            Column::make('booking')->title(__('warehouse::view.booking_no')),
            Column::make('booking_date')->title(__('warehouse::view.booking_date')),
            Column::make('closed_on')->title(__('warehouse::view.closed_on')),
            Column::make('load_plans')->title(__('warehouse::view.load_plans')),
            Column::make('containers')->title(__('warehouse::view.containers')),
            Column::make('attachments')->title(__('warehouse::view.attachments')),
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
        return 'Bookings_'.date('YmdHis');
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
