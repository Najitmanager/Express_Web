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


            <a href="{{ fr_route('docks.create') }}" class="btn btn-primary m-1" >{{ __('warehouse::view.add_dock') }}</a>

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

<link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
<script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
    $('#{{ $table_id }} tbody').on('click', 'tr', function() {
        // Remove color from all rows
        $('#{{ $table_id }} tbody tr').css('background-color', '').css('color', '');

        // Apply color only to the clicked row
        var item = $(this);
        item.css('background-color', '#ffefbb').css('color', '#000000');

        // Get the href attribute
        var href = item.find('a').attr('href');
        if (href) {
            url = href;
        }
    });

    $('#{{ $table_id }} tbody').on('dblclick', 'tr', function() {
        if (url) {

            window.location = url;
        }
    });
</script>
