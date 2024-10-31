@extends('warehouse::adminLte.layouts.master')


@section('content')
    <!--begin::Card-->
    <div class="card table-card-wrapper">

        {{-- start page title --}}
        <div class="table-header card-header">

            <div class="custom-title">
                <i class="fa-solid fa-car fa-fw"></i>{{ __('warehouse::view.vehicles') }}
            </div>

        </div>
        {{-- end page title --}}

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
                    @include('adminLte.components.modules.datatable.reload', ['table_id' => $table_id])

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

                    <!--begin::Add New Port-->
                    {{--                    @if (auth()->user()->can('create-packages') || $user_role == $admin) --}}
                    <a href="#" class="btn btn-primary m-1" data-toggle="modal" data-target="#modal-overlay">{{ __('warehouse::view.add_vehicle') }}</a>

                    {{--                    @endif --}}
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    //                    'permission' => 'delete-packages',
                    'url' => fr_route('vehicles.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('warehouse::view.selected_vehicles'),
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

    <div class="modal fade" id="modal-overlay">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div id="preloader" class="overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-overlay-title">{{ __('warehouse::view.create_new_vehicle') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--begin::Form-->
            <div class="custom-modal-body">
                <form id="form_body" action="{{ fr_route('vehicles.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-5">
                            @include('warehouse::adminLte.pages.vehicles.form', ['typeForm' => 'create'])
                        </div>
                        <!--end::Card body-->

                    </div>
                    <div class="modal-footer justify-content-navbar">
                        <button type="button" class="btn btn-custom-discard" data-dismiss="modal">@lang('view.discard')</button>
                        <button type="button" class="btn btn-custom-save" id="form_submit">@lang('view.create')</button>
                    </div>
                </form>
            </div>
                <!--end::Form-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@endsection


@section('toolbar-btn')
    <!--begin::Button-->
    {{--     <a href="{{ fr_route('users.create') }}" class="btn btn-sm btn-primary">Create <i class="ms-2 fas fa-plus"></i> </a>--}}
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

        let url;
        $(document).ready(function() {
            $('#{{$table_id}} tbody').on('click', 'tr', function() {
                // Remove color from all rows
                $('#{{$table_id}} tbody tr').css('background-color', '').css('color', '');

                // Apply color only to the clicked row
                var item = $(this);
                item.css('background-color', '#ffefbb').css('color', '#000000');

                // Get the href attribute
                var href = item.find('a').attr('href');
                if (href) {
                    url = href;
                }
            });

            $('#{{$table_id}} tbody').on('dblclick', 'tr', function() {
                if (url) {
                    // $.ajax({
                    //     url: url, // Adjust the endpoint as needed
                    //     type: 'GET',
                    //     success: function (data) {
                    //         if (data['value']===1) {
                    //             $('.custom-modal-body').html(data['view'])
                    //         }
                    //     },
                    //     error: function () {
                    //         console.error("Failed to fetch models.");
                    //     }
                    // });
                    window.location=url;
                }
            });

            $('#make-select').on('change', function () {
                const makeId = $(this).val();

                if (makeId) {
                    // Make AJAX request to get models based on selected make
                    $.ajax({
                        url: `/get-models/${makeId}`, // Adjust the endpoint as needed
                        type: 'GET',
                        success: function (data) {
                            // Clear old data in the model-select dropdown
                            $('#model-select').empty();

                            // Append new options to model-select
                            {{--$('#model-select').append('<option>{{ __('warehouse::view.table.choose_model') }}</option>');--}}
                            data.models.forEach(function (model) {
                                $('#model-select').append(
                                    `<option value="${model.id}">${model.name}</option>`
                                );
                            });

                            // Refresh Select2 to show updated options
                            // $('#model-select').select2();
                        },
                        error: function () {
                            console.error("Failed to fetch models.");
                        }
                    });
                } else {
                    // Clear model-select if no make is selected
                    $('#model-select').empty().append('<option>{{ __('warehouse::view.table.choose_model') }}</option>').select2();
                }
            });
            $('#pull_info').on('click',function (){
                var vin = $('#vin_input').val();

                if (vin === ''||vin === null || typeof vin === "undefined"){
                    Toast.fire({
                        icon: 'error',
                        title: 'VIN is required'
                    })
                }else {
                    $.ajax({
                        url: `/pull-vehicle-info/${vin}`, // Adjust the endpoint as needed
                        type: 'GET',
                        beforeSend: function () {
                            // Show preloader before the request starts
                            $('#preloader').show();
                        },
                        success: function (data) {
                            if(data['value']===1){
                                $('.vehicle_type').html(data['type_view'])
                                $('.vehicle_info').html(data['vehicle_view'])
                            }

                        },
                        error: function () {
                            console.error("Failed to fetch models.");
                        },
                        complete: function () {
                            // Hide preloader after the request completes
                            $('#preloader').hide();
                        }
                    });
                }

            })

            /* ============> Submit form <======================== */

            $('#form_submit').on('click', function (e) {
                e.preventDefault(); // Prevent default form submission

                let formData = new FormData($('#form_body')[0]); // Gather form data

                $.ajax({
                    url: $('#form_body').attr('action'), // Get form action URL
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function (response) {
                        // Handle success response
                        if (response.success) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Vehicle created successfully!'
                            })
                            // You might close the modal here or update the page dynamically
                            // $('#form_body')[0].reset(); // Reset the form after successful submission
                            // $('.vehicle_type').reset(); // Reset the form after successful submission
                            $('#modal-overlay').modal('hide'); // Hide the modal if necessary

                            var tableId = '{{ $table_id }}';
                            var table = $('#' + tableId);
                            table.DataTable().ajax.reload()
                        } else {

                            Toast.fire({
                                icon: 'error',
                                title: 'Failed to create Booking. Please try again.'
                            })
                        }
                    },
                    error: function(xhr) {
                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.message
                        })
                    }
                });
            });

        });


    </script>

@endsection

