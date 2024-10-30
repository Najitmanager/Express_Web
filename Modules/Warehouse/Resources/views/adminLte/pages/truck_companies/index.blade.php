@extends('warehouse::adminLte.layouts.master')



@section('content')
    <!--begin::Card-->
    <div class="card table-card-wrapper">

        {{-- start page title --}}
        <div class="table-header card-header">

            <div class="custom-title">
                <i class="fa-solid fa-car fa-fw"></i>{{ __('warehouse::view.truck_companies') }}
            </div>

        </div>
        {{-- end page title --}}

        <!--begin::Card header-->
        <div class="card-header border-0">
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
                    @include('adminLte.components.modules.datatable.reload', ['table_id' => $table_id])

                    @include('adminLte.components.modules.datatable.export', [
                        'table_id' => $table_id,
                        'btn_exports' => $btn_exports,
                    ])

                    <!--begin::Add New Port-->
                    {{--                    @if (auth()->user()->can('create-packages') || $user_role == $admin) --}}
                    <a href="{{ fr_route('truck_companies.create') }}"
                        class="btn btn-primary m-1">{{ __('warehouse::view.add_truck_company') }}</a>
                    {{--                    @endif --}}
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    //                    'permission' => 'delete-packages',
                    'url' => fr_route('truck_companies.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('warehouse::view.selected_truck_companies'),
                ])
                <!--end::Group actions-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->


        <!--begin::Card body-->
        <div class="card-body pt-0">

            <!--begin::Table-->
            {{ $dataTable->table() }}
            <!--end::Table-->


        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection


@section('toolbar-btn')
    <!--begin::Button-->
    {{--     <a href="{{ fr_route('users.create') }}" class="btn btn-sm btn-primary">Create <i class="ms-2 fas fa-plus"></i> </a> --}}
    <!--end::Button-->
@endsection


{{-- Inject styles --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">
@endsection

{{-- Inject Scripts --}}
@section('scripts')
    <script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>
        function update_truck_company_active(el) {
            var id = $(el).data('row-id');
            if (el.checked) {
                var active = 1;
            } else {
                var active = 0;
            }

            $.post('{{ route('truck_companies.update_active') }}', {
                _token: '{{ csrf_token() }}',
                id: id,
                active: active
            }, function(data) {
                if (data == 1) {
                    Swal.fire("{{ __('currency::messages.saved') }}", "", "");
                } else {
                    Swal.fire("{{ __('currency::messages.something_wrong') }}", "", "");
                }
            });
        }
        let url;
        $(document).ready(function() {
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
        });
    </script>
@endsection
