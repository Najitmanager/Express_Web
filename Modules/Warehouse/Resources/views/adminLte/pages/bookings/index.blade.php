

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
                    <a href="#" class="btn btn-primary m-1" data-toggle="modal"
                       data-target="#modal-overlay">{{ __('warehouse::view.add_booking') }}</a>
                    {{--                    @endif --}}
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Group actions-->
                @include('adminLte.components.modules.datatable.columns.checkbox-actions', [
                    'table_id' => $table_id,
                    //                    'permission' => 'delete-packages',
                    'url' => fr_route('bookings.multi-destroy'),
                    'callback' => 'reload-table',
                    'model_name' => __('warehouse::view.selected_bookings'),
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

    <!--end::Card-->


    <div class="modal fade" id="modal-overlay">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div id="preloader" class="overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-overlay-title">{{ __('warehouse::view.add_booking') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--begin::Form-->
                <form id="form_body" action="{{ fr_route('bookings.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            @include('warehouse::adminLte.pages.bookings.form', ['typeForm' => 'create'])
                        </div>
                        <!--end::Card body-->

                    </div>
                    <div class="modal-footer justify-content-navbar">
                        <button type="button" class="btn btn-custom-discard" data-dismiss="modal"><i
                                class="fa-solid fa-ban"></i> @lang('view.discard')</button>
                        <button type="button" class="btn btn-custom-save" data-dismiss="modal" id="form_submit"><i
                                class="fa-regular fa-floppy-disk"></i> @lang('view.create')</button>
                    </div>
                </form>

                <!--end::Form-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- /.modal -->
    <div class="modal fade" id="modal-overlay-edit">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div id="preloader-edit" class="overlay" style="display: none;">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-overlay-title-edit">{{ __('warehouse::view.edit_port') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--begin::Form-->
                <div class="custom-modal-body">
                </div>
                <!--end::Form-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



{{-- Inject styles --}}


    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.css') }}">



{{-- Inject Scripts --}}

    <script src="{{ asset('assets/lte/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>

        let url;
        $(document).ready(function() {
            $('#{{ $table_id }} tbody').on('click', 'tr', function() {
                // Remove color from all rows
                $('#{{ $table_id }} tbody tr').css('background-color', '').css('color', '');

                // Apply color only to the clicked row
                var item = $(this);
                item.css('background-color', '#ffefbb').css('color', '#000000');

                // Get the href attribute
                var href = item.find('a').data('href');
                console.log(href);
                if (href) {
                    url = href;
                }
            });

            $('#{{ $table_id }} tbody').on('dblclick', 'tr', function() {
                if (url) {
                    $.ajax({
                        url: url, // Adjust the endpoint as needed
                        type: 'GET',
                        success: function(data) {
                            $('.custom-modal-body').html(data['view']);

                            $('#modal-overlay-edit').modal('show');
                        },
                        error: function() {
                            console.error("Failed to fetch models.");
                        }
                    });
                }
            });

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
                                title: 'Customer created successfully!'
                            })
                            // You might close the modal here or update the page dynamically
                            // $('#form_body')[0].reset(); // Reset the form after successful submission
                            // $('.vehicle_type').reset(); // Reset the form after successful submission
                            e.preventDefault(); // Prevent default form submission
                            setTimeout(function() {
                                $('#modal-overlay').modal('hide');
                            }, 1000);

                            var tableId = '{{ $table_id }}';
                            var table = $('#' + tableId);
                            table.DataTable().ajax.reload();
                        } else {
                            alert('Failed to create Customer. Please try again.');
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
