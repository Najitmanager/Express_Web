@extends('warehouse::adminLte.layouts.master')


@section('content')
    <!--begin::Card-->
    <div class="card table-card-wrapper">

        <ul class="nav nav-tabs table-header card-header justify-content-start" id="mainTab" role="tablist">
            <li class="nav-item custom-title  index-btn" role="presentation" data-href="tab1">
                <a class="nav-link text-dark border-0 active " id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">
                    <i class="fa-solid fa-file-alt me-2"></i>{{ __('warehouse::view.docks') }}
                </a>
            </li>
            <li class="nav-item custom-title ms-2 index-btn" role="presentation" data-href="tab2">
                <a class="nav-link text-dark border-0" id="tab2-tab" data-bs-toggle="tab" href="#tab2"
                    role="tab">
                    <i class="fa-solid fa-file-alt me-2"></i> {{ __('warehouse::view.load_plans') }}
                </a>
            </li>
            <li class="nav-item custom-title ms-2 index-btn" role="presentation" data-href="tab3">
                <a class="nav-link text-dark border-0" id="tab3-tab" data-bs-toggle="tab" href="#tab3"
                    role="tab">
                    <i class="fa-solid fa-list me-2"></i> {{ __('warehouse::view.bookings') }}
                </a>
            </li>
        </ul>
        <div id="overlay-loader" class="overlay dark" style="display: none;">
            <i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Loading...</div>
        </div>
        <div class="tab-content" id="tabContent">

            <!-- Tab 1 Content -->
            <div class="tab-pane fade show  active" id="tab1" role="tabpanel">

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
                <!--end::Card body-->

            </div>

            <div  class="tab-pane  fade" id="tab2" role="tabpane2">



            </div>

            <div class="tab-pane  fade" id="tab3" role="tabpane3">



            </div>

        </div>


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
            $('.index-btn').on('click',function (){

                var tab= $(this).data('href');
                switch (tab){
                    case 'tab1':
                        get_index('{{ fr_route('docks.get.index') }}',tab)
                        break
                    case 'tab2':
                        get_index('{{ fr_route('docks.get.loadPlans') }}',tab)
                        break
                    case 'tab3':
                        get_index('{{ fr_route('bookings.index') }}',tab)
                        break
                }
            });
            function get_index(url,tab){
                $.ajax({
                    url: url, // Adjust the endpoint as needed
                    type: 'GET',
                    beforeSend: function () {
                        // Show preloader before the request starts
                        $('#overlay-loader').show();
                        $('#'+tab).html('')
                    },
                    success: function (data) {
                        if (tab==='tab1'){
                            $('#tab2').html('');
                            $('#tab3').html('');
                        }else if(tab==='tab2') {
                            $('#tab1').html('');
                            $('#tab3').html('');
                        }else {
                            $('#tab1').html('');
                            $('#tab2').html('');
                        }

                        $('#'+tab).html(data)

                    },
                    error: function () {
                        console.error("Failed to fetch models.");
                    },
                    complete: function () {
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




    {{-- Start Open New Tab on double click --}}
    <script>
        // let tabCount = 3;

        // Event listener for row double-clicks to create a new detail tab
        // $('table').on('dblclick', 'tr', function() {
        //     const item = $(this).find('td:first').text();
        //     const details = $(this).find('td:last').text();
        //     const tabId = `tab${tabCount}`;

            // Add new tab to the navigation with a close button
            // $('#mainTab').append(`
            //     <li class="nav-item custom-title ml-2" role="presentation" id="${tabId}-tab-container">
            //     <a class="nav-link border-0 text-dark" id="${tabId}-tab" data-bs-toggle="tab" href="#${tabId}" role="tab">
            //         ${item} <button type="button" class="btn-close ms-2 p-0 btn btn-sm btn-light" aria-label="Close"><i class="fa-solid fa-xmark text-danger"></i></button>
            //     </a>
            //     </li>
            // `);

            // Add new tab content
            // $('#tabContent').append(`
            //     <div class="tab-pane fade" id="${tabId}" role="tabpanel">
            //     <h5 class="mt-3">Details for ${item}</h5>
            //     <p>${details}</p>
            //     </div>
            // `);

            // Activate the new tab
            // $(`#${tabId}-tab`).tab('show');
            // tabCount++;

            // Close tab on close button click
            // $(`#${tabId}-tab-container .btn-close`).on('click', function(e) {
            //     e.stopPropagation(); // Prevent the tab from activating
            //     const tabPaneId = $(this).closest('.nav-item').find('.nav-link').attr('href');
            //     $(tabPaneId).remove(); // Remove tab content
            //     $(this).closest('.nav-item').remove(); // Remove tab header

                // Show the first tab if there are no active tabs
        //         if (!$('#mainTab .nav-link.active').length) {
        //             $('#mainTab .nav-link:first').tab('show');
        //         }
        //     });
        // });
    </script>
    {{-- End Open New Tab on double click --}}
@endsection
