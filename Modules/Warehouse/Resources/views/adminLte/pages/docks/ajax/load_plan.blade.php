<!--begin::Card header-->
<div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title">

        <!--begin::Search-->
        {{-- search table --}}
        @include('adminLte.components.modules.datatable.search', ['table_id' => $table_id])
        <!--end::Search-->

    </div>
    <!--begin::Card title-->

    <!--begin::Card toolbar-->
    <div class="card-toolbar">
        <!--begin::Toolbar-->
        <div class="d-flex flex-wrap align-items-center" id="{{ $table_id }}_custom_filter">
            {{-- data table length --}}
            @include('adminLte.components.modules.datatable.datatable_length', [
                'table_id' => $table_id,
            ])
            {{-- btn reload table --}}
            @include('adminLte.components.modules.datatable.reload', [
                'table_id' => $table_id,
            ])

            @include('adminLte.components.modules.datatable.export', [
                'table_id' => $table_id,
                'btn_exports' => $btn_exports,
            ])

            <!--begin::Filter-->
            <x-table-filter :table_id="$table_id" :filters="$filters">
                {{-- Start Custom Filters --}}
                <!-- ================== begin Role filter =============================== -->
                @include('cargo::adminLte.pages.table.filters.client', [
                    'table_id' => $table_id,
                    'filters' => $filters,
                ])
                @include('cargo::adminLte.pages.table.filters.branch', [
                    'table_id' => $table_id,
                    'filters' => $filters,
                ])
                <!-- ================== end Role filter =============================== -->
                <!-- ================== end Role filter =============================== -->
                {{-- End Custom Filters --}}
            </x-table-filter>
            <!--end::Filter-->


            <a href="#" class="btn btn-primary m-1" data-toggle="modal"
               data-target="#modal-overlay">{{ __('warehouse::view.add_dock') }}</a>

            <!--end::Add user-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Group actions-->
        @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
            'table_id' => $table_id,
            //                    'permission' => 'delete-packages',
            'url' => fr_route('docks.multi-destroy'),
            'callback' => 'reload-table',
            'model_name' => __('warehouse::view.selected_docks'),
        ])
        <!--end::Group actions-->

    </div>
    <!--end::Card toolbar-->
</div>
<!--end::Card header-->


<!--begin::Card body-->
<div class="card-body pt-6">

    <!--begin::Table-->
    {{ $dataTable->table() }}
    <!--end::Table-->


</div>
<!--end::Card body-->
{{-- Start Create Modal --}}
<div class="modal fade" id="modal-overlay">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="preloader" class="overlay" style="display: none;">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="modal-overlay-title">{{ __('warehouse::view.create_new_Dock') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--begin::Form-->
            <div class="custom-modal-body">
                <form id="form_body" action="{{ fr_route('Docks.store') }}" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-body">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            @include('warehouse::adminLte.pages.Docks.form', [
                                'typeForm' => 'create',
                            ])
                        </div>
                        <!--end::Card body-->

                    </div>
                    <div class="modal-footer justify-content-navbar">
                        <button type="button" class="btn btn-custom-discard"
                                data-dismiss="modal">@lang('view.discard')</button>
                        <button type="button" class="btn btn-custom-save"
                                id="form_submit">@lang('view.create')</button>
                    </div>
                </form>
            </div>
            <!--end::Form-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- End Create Modal --}}
<link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
<script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{ $dataTable->scripts() }}
