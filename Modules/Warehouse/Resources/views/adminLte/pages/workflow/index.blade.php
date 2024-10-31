@extends('warehouse::adminLte.layouts.master')


@section('content')
    <!--begin::Card-->
    <div class="card table-card-wrapper">

        <ul class="nav nav-tabs table-header card-header justify-content-start border-0" id="mainTab" role="tablist">
            <li class="nav-item custom-title index-btn custom-bg-danger" role="presentation" data-href="tab1">
                <a class="text-light border-0 active " id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">
                    <img src="https://express.nejoum.net/resources/workflow-icons/icons8-new-80.png" width="25px"
                        class="me-2" alt="">{{ __('warehouse::view.New Vehicles') }}
                    ({{ count(get_vehicles(0)) }})
                </a>
            </li>
            <li class="nav-item custom-title ms-2 index-btn custom-bg-warning" role="presentation" data-href="tab2">
                <a class="text-light border-0" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">
                    <img src="https://express.nejoum.net/resources/workflow-icons/icons8-warehouse-100.png" width="25px"
                        class="me-2" alt=""> {{ __('warehouse::view.In Warehouse') }}
                    ({{ count(get_vehicles(1)) }})
                </a>
            </li>
            <li class="nav-item custom-title ms-2 index-btn custom-bg-blue" role="presentation" data-href="tab3">
                <a class="text-light border-0" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">
                    <img src="https://express.nejoum.net/resources/workflow-icons/icons8-sent-200.png" width="25px"
                        class="me-2" alt=""> {{ __('warehouse::view.Shipped') }} ({{ count(get_vehicles(2)) }})
                </a>
            </li>
        </ul>
        <div id="overlay-loader" class="overlay dark" style="display: none;">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
            <div class="text-bold pt-2">Loading...</div>
        </div>
        <div class="tab-content" id="tabContent">

            <!-- Tab 1 Content -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">

                <div class="p-2 custom-bg-danger rounded-0">

                    <div class="d-inline-flex justify-content-start flex-wrap gap-2">
                        <div class="">
                            <input type="search" class="btn btn-light btn-sm px-4 rounded-0 text-start"
                                placeholder="Search" style="width: 150px;" />
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="dsdsds" data-control="select2"
                                    data-placeholder="Filter By Company" data-allow-clear="true" data-select2-id="1"
                                    tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="country_id" data-control="select2"
                                    data-placeholder="Filter By Port" data-allow-clear="true" data-select2-id="2"
                                    tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <span class="mx-2 text-light">|</span>
                            <button type="search" class="btn btn-light btn-sm px-4 rounded-0">
                                <i class="fa-solid fa-arrows-rotate text-success"></i>
                                Reload
                            </button>
                        </div>

                    </div>

                </div>
                <d   iv id="custom-tab1">
                    <!--begin::Card header-->
                    {{-- <div class="card-header border-0 pt-6"> --}}
                        <!--begin::Card title-->
                        {{-- <div class="card-title"> --}}

                            <!--begin::Search-->
                            {{-- search table --}}
                            {{-- @include('adminLte.components.modules.datatable.search', [
                                'table_id' => $table_id,
                            ]) --}}
                            <!--end::Search-->

                        {{-- </div> --}}
                        <!--begin::Card title-->

                        <!--begin::Card toolbar-->
                        {{-- <div class="card-toolbar"> --}}
                            <!--begin::Toolbar-->
                            {{-- <div class="d-flex flex-wrap align-items-center" id="{{ $table_id }}_custom_filter"> --}}
                                {{-- data table length --}}
                                {{-- @include('adminLte.components.modules.datatable.datatable_length', [
                                    'table_id' => $table_id,
                                ]) --}}
                                {{-- btn reload table --}}
                                {{-- @include('adminLte.components.modules.datatable.reload', [
                                    'table_id' => $table_id,
                                ])

                                @include('adminLte.components.modules.datatable.export', [
                                    'table_id' => $table_id,
                                    'btn_exports' => $btn_exports,
                                ]) --}}

                                <!--begin::Filter-->
                                {{-- <x-table-filter :table_id="$table_id" :filters="$filters"> --}}
                                    {{-- Start Custom Filters --}}
                                    <!-- ================== begin Role filter =============================== -->
                                    {{-- @include('cargo::adminLte.pages.table.filters.client', [
                                        'table_id' => $table_id,
                                        'filters' => $filters,
                                    ])
                                    @include('cargo::adminLte.pages.table.filters.branch', [
                                        'table_id' => $table_id,
                                        'filters' => $filters,
                                    ]) --}}
                                    <!-- ================== end Role filter =============================== -->
                                    <!-- ================== end Role filter =============================== -->
                                    {{-- End Custom Filters --}}
                                {{-- </x-table-filter> --}}
                                <!--end::Filter-->


                                {{-- <a href="#" class="btn btn-primary m-1" data-toggle="modal"
                                    data-target="">{{ __('warehouse::view.add_dock') }}</a> --}}

                                <!--end::Add user-->
                            {{-- </div> --}}
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
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        {{ $dataTable->table() }}
                        <!--end::Table-->


                    </div>
                    <!--end::Card body-->
                </div>

            </div>

            <div class="tab-pane fade" id="tab2" role="tabpane2">
                <div class="p-2 custom-bg-warning rounded-0">

                    <div class="d-inline-flex justify-content-start flex-wrap gap-2">

                        <div class="">
                            <input type="search" class="btn btn-light btn-sm px-4 rounded-0 text-start"
                                placeholder="Search" style="width: 150px;" />
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="dsdsds" data-control="select2"
                                    data-placeholder="Filter By Company" data-allow-clear="true" data-select2-id="7"
                                    tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="country_id"
                                    data-control="select2" data-placeholder="Filter By Port" data-allow-clear="true"
                                    data-select2-id="6" tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <span class="mx-2 text-light">|</span>
                            <button type="search" class="btn btn-light btn-sm px-4 rounded-0">
                                <i class="fa-solid fa-file text-success"></i>
                                Create Load Plan
                            </button>
                        </div>

                        <div class="">
                            <span class="mx-2 text-light">|</span>
                            <button type="search" class="btn btn-light btn-sm px-4 rounded-0 d-flex flex-row justify-content-center gap-2">
                                <i class="fa-solid fa-arrows-rotate text-success"></i>
                                Reload
                            </button>
                        </div>

                    </div>

                </div>
                <div id="custom-tab2"></div>

            </div>

            <div class="tab-pane fade" id="tab3" role="tabpane3">

                <div class="p-2 custom-bg-blue rounded-0">
                    <div class="d-inline-flex justify-content-start flex-wrap gap-2">

                        <div class="">
                            <input type="search" class="btn btn-light btn-sm px-4 rounded-0 text-start"
                                placeholder="Search" style="width: 150px;" />
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="dsdsds" data-control="select2"
                                    data-placeholder="Filter By Company" data-allow-clear="true" data-select2-id="5"
                                    tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <select class="btn btn-light btn-sm px-4 rounded-0" name="country_id"
                                    data-control="select2" data-placeholder="Filter By Port" data-allow-clear="true"
                                    data-select2-id="4" tabindex="-1" aria-hidden="true"
                                    style="height: 32px; display: flex; align-items: center;">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <span class="mx-2 text-light">|</span>
                            <button type="search" class="btn btn-light btn-sm px-4 rounded-0">
                                <i class="fa-solid fa-arrows-rotate text-success"></i>
                                Reload
                            </button>
                        </div>

                    </div>
                </div>

                <div id="custom-tab3"></div>


            </div>

        </div>

        {{-- Start Create Modal --}}
        <div class="modal fade" id="modal-overlay">
            <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                <div class="card-body border-top p-5">
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
    </div>
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
            $('.index-btn').on('click', function() {

                var tab = $(this).data('href');
                switch (tab) {
                    case 'tab1':
                        get_index('{{ fr_route('docks.get.index') }}', tab)
                        break
                    case 'tab2':
                        get_index('{{ fr_route('docks.get.index') }}', tab)
                        break
                    case 'tab3':
                        get_index('{{ fr_route('bookings.index') }}', tab)
                        break
                }
            });

            function get_index(url, tab) {
                $.ajax({
                    url: url, // Adjust the endpoint as needed
                    type: 'GET',
                    beforeSend: function() {
                        // Show preloader before the request starts
                        $('#overlay-loader').show();
                        $('#custom-' + tab).html('')
                    },
                    success: function(data) {
                        if (tab === 'tab1') {
                            $('#custom-tab2').html('');
                            $('#custom-tab3').html('');
                        } else if (tab === 'tab2') {
                            $('#custom-tab1').html('');
                            $('#custom-tab3').html('');
                        } else {
                            $('#custom-tab1').html('');
                            $('#custom-tab2').html('');
                        }

                        $('#custom-' + tab).html(data)

                    },
                    error: function() {
                        console.error("Failed to fetch models.");
                    },
                    complete: function() {
                        $('#overlay-loader').hide();
                    }
                });
            }


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
                    window.location = url;
                }
            });

            $('#make-select').on('change', function() {
                const makeId = $(this).val();

                if (makeId) {
                    // Make AJAX request to get models based on selected make
                    $.ajax({
                        url: `/get-models/${makeId}`, // Adjust the endpoint as needed
                        type: 'GET',
                        success: function(data) {
                            // Clear old data in the model-select dropdown
                            $('#model-select').empty();

                            // Append new options to model-select
                            {{-- $('#model-select').append('<option>{{ __('warehouse::view.table.choose_model') }}</option>'); --}}
                            data.models.forEach(function(model) {
                                $('#model-select').append(
                                    `<option value="${model.id}">${model.name}</option>`
                                );
                            });

                            // Refresh Select2 to show updated options
                            // $('#model-select').select2();
                        },
                        error: function() {
                            console.error("Failed to fetch models.");
                        }
                    });
                } else {
                    // Clear model-select if no make is selected
                    $('#model-select').empty().append(
                        '<option>{{ __('warehouse::view.table.choose_model') }}</option>').select2();
                }
            });
            $('#pull_info').on('click', function() {
                var vin = $('#vin_input').val();

                if (vin === '' || vin === null || typeof vin === "undefined") {
                    Toast.fire({
                        icon: 'error',
                        title: 'VIN is required'
                    })
                } else {
                    $.ajax({
                        url: `/pull-Dock-info/${vin}`, // Adjust the endpoint as needed
                        type: 'GET',
                        beforeSend: function() {
                            // Show preloader before the request starts
                            $('#preloader').show();
                        },
                        success: function(data) {
                            if (data['value'] === 1) {
                                $('.Dock_type').html(data['type_view'])
                                $('.Dock_info').html(data['Dock_view'])
                            }

                        },
                        error: function() {
                            console.error("Failed to fetch models.");
                        },
                        complete: function() {
                            // Hide preloader after the request completes
                            $('#preloader').hide();
                        }
                    });
                }

            })

            /* ============> Submit form <======================== */

            $('#form_submit').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                let formData = new FormData($('#form_body')[0]); // Gather form data

                $.ajax({
                    url: $('#form_body').attr('action'), // Get form action URL
                    type: 'POST',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        // Handle success response
                        if (response.success) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Vehicle created successfully!'
                            })
                            // You might close the modal here or update the page dynamically
                            // $('#form_body')[0].reset(); // Reset the form after successful submission
                            // $('.Dock_type').reset(); // Reset the form after successful submission
                            $('#modal-overlay').modal('hide'); // Hide the modal if necessary

                            var tableId = '{{ $table_id }}';
                            var table = $('#' + tableId);
                            table.DataTable().ajax.reload()
                        } else {
                            alert('Failed to create Dock. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        // Handle error response
                        alert('An error occurred. Please try again.');
                        console.error(xhr.responseText); // Log error for debugging
                    }
                });
            });

        });
    </script>
@endsection
