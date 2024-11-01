@extends('warehouse::adminLte.layouts.master')

@section('content')
    <!--begin::Card-->

    <div class="card table-card-wrapper">
        <div class="table-header card-header">
            <div class="custom-title">
                {{ __('warehouse::view.New Dock Receipt') }}
            </div>
        </div>
        <form id="kt_account_profile_details_form" class="form" action="{{ fr_route('docks.store') }}" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between p-2 flex-wrap gap-2 border-bottom border-secodary">

            <div class="d-flex gap-2 ">
                <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-floppy-disk text-success me-2"></i> {{ __('view.save') }}
                </button>
                <button type="button" type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-floppy-disk text-success me-2"></i> {{ __('warehouse::view.Save & Close') }}
                </button>
                <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-print text-success me-2"></i> {{ __('warehouse::view.print') }}
                </button>
            </div>

            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                <i class="fa-regular fa-circle-xmark text-danger me-2"></i> {{ __('warehouse::view.Close') }}
            </button>
        </div>

            {{-- Start Topper Form --}}
            <div class="card table-card-wrapper dock-page m-3 p-3" style="min-height: auto">
                <div class="row justify-content-between">
                    {{-- form left side --}}
                    <div class="col-lg-6">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4 mb-2">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.document_no') }}.</label>
                                <input type="text" name="document_no" class="form-control" placeholder="auto">
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.booking_no') }}.</label>
                                <select name="booking_id" class="form-select form-select-sm" aria-label="Small select example">
                                   @foreach(get_bookings() as $booking)
                                        <option value="{{ $booking->id }}">{!! $booking->name_icon !!} </option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 d-flex justify-content-start align-items-center gap-2">
                                <input name="load_plan_received" type="checkbox">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.Load Plan Received') }}</label>
                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.container_no') }}.</label>
                                <input type="text" name="container_no" class="form-control">

                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.Seal No') }}.</label>
                                <input type="text" name="seal_no" class="form-control">

                            </div>
                            <div class="col-lg-4 mb-2">
                                <label for="name" class="form-label mb-1">{{ __('warehouse::view.AES No') }}.</label>
                                <input type="text" name="aes_no" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">{{ __('warehouse::view.Type Of Move') }}.</label>
                            <input type="text"  name="type_of_moves" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">{{ __('warehouse::view.Loading/Pier Terminal') }}.</label>
                            <input type="text" name="terminal" class="form-control">

                        </div>
                        <div class="col-lg-4 d-flex justify-content-start align-items-center gap-2">
                            <input name="booking_received" type="checkbox">
                            <label for="name"  class="form-label mb-1">{{ __('warehouse::view.Booking Received') }}.</label>

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">{{ __('warehouse::view.Container Loading Date') }}.</label>
                            <input type="date" name="loading_date" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">{{ __('warehouse::view.Container in Gate Date') }}.</label>
                            <input type="date" name="in_gate_date" class="form-control">
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">{{ __('warehouse::view.Departure Date') }}.</label>
                            <input type="date" name="departure_date" class="form-control">

                        </div>
                    </div>
                </div>
                {{-- form right side --}}
                <div class="col-lg-5">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-12">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.customer') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <select name="client_id" class="form-select form-select-sm" aria-label="Small select example">
                                        @foreach(get_customers() as $client)
                                            <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.table.consignee') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <select name="consignee_id" class="form-select form-select-sm" aria-label="Small select example">
                                        @foreach(get_consignees() as $consignee)
                                            <option value="{{ $consignee->id }}">{{ $consignee->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.Notify Party') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="notify_party" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.Trucking Company') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <select name="truck_company_id" class="form-select form-select-sm" aria-label="Small select example">
                                        @foreach(get_trucking_companies() as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.Exporting Carrier') }} : </label>
                                </div>
                                <div class="col-md-9">
                                    <select name="carrier_id" class="form-select form-select-sm" aria-label="Small select example">
                                        @foreach(get_carriers() as $carrier)
                                            <option value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.Vessel Name') }}: </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="vessel_name" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.Voyage') }}: </label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="voyage" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> {{ __('warehouse::view.table.port') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        @foreach(get_ports() as $port)
                                            <option value="{{ $port->id }}">{{ $port->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Topper Form --}}

        {{-- Start Lower Card --}}
        <div class="card table-card-wrapper dock-page m-3 p-3" style="min-height: auto">
            <ul class="nav nav-tabs table-header card-header justify-content-start flex-wrap gap-2" id="mainTab"
                role="tablist">
                <li class="nav-item custom-title tabs-only p-0 index-btn" role="presentation" data-href="tab1">
                    <a class="nav-link border-0 active " id="tab1-tab" data-bs-toggle="tab" href="#tab1"
                        role="tab">
                        {{ __('warehouse::view.Vehicle List') }} (0)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab2">
                    <a class="nav-link border-0" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">
                        {{ __('warehouse::view.Loading Photos') }} (0)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab3">
                    <a class="nav-link border-0" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">
                        Attachments (0)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab4">
                    <a class="nav-link border-0" id="tab4-tab" data-bs-toggle="tab" href="#tab4" role="tab">
                        Messages (0)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab5">
                    <a class="nav-link border-0" id="tab5-tab" data-bs-toggle="tab" href="#tab5" role="tab">
                        California Cover Letter (0)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab6">
                    <a class="nav-link border-0" id="tab6-tab" data-bs-toggle="tab" href="#tab6" role="tab">
                        Washington Cover Letter (0)
                    </a>
                </li>
            </ul>
            <div id="overlay-loader" class="overlay dark" style="display: none;">
                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                <div class="text-bold pt-2">Loading...</div>
            </div>
            <div class="tab-content" id="tabContent">

                <!-- Tab 1 Content  -- Vehicle List -->
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                    <div class="d-flex justify-content-between p-2 flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center" data-toggle="modal"
                            data-target="#modal-overlay">
                            <i class="fa-solid fa-plus text-success me-2"></i> Add vehicle
                        </button>

                            <div class="d-flex align-items-center gap-2">
                                <label for="name" class="form-label mb-0" style="width: 150px !important;"> container
                                    size. </label>
                                <select name="container_size" class="form-select form-select-sm">
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="20">20</option>
                                </select>
                            </div>

                        </div>

                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-3">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Vehicle Name/VIN</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Port/Customer</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Hat</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Weight/Price</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Notes</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Title #/ State</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Title</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Key</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                    </th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Title</td>--}}
{{--                                    <td class="p-1 px-4">500</td>--}}
{{--                                    <td class="p-1 px-4">500</td>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Title</td>--}}
{{--                                    <td class="p-1 px-4">500</td>--}}
{{--                                    <td class="p-1 px-4">500</td>--}}
{{--                                    <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>--}}
{{--                                    <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>--}}
{{--                                    <td class="p-1 px-4"><i class="fa-regular fa-pen-to-square text-warning"></i></td>--}}
{{--                                    <td class="p-1 px-4"><i class="fa-regular fa-trash-can text-danger"></i></td>--}}
{{--                                </tr>--}}

                            </tbody>
                        </table>

                    </div>
                    <!-- Tab 2 Content  --  Loading Photos -->
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="d-flex justify-content-between p-2 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <input type="file" class="btn btn-sm  btn-light px-3">
                                <a href="#" class="btn btn-sm  btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-solid fa-download text-success "></i> Download ALl Photos
                                </a>
                                <a href="#" class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-image text-danger"></i> Container No Photo
                                </a>
                                <a href="#" class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-image text-primary"></i> Seal No Photo
                                </a>
                                <a href="#" class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-image text-secondary"></i> Lading Photo
                                </a>
                                <a href="#" class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-eye text-secondary"></i> Show Photo Info
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-regular fa-trash-can text-danger me-2"></i> Delete Selected
                            </button>
                        </div>

                        <div class="card-body p-0 pb-0 pt-0">
                            <div class="d-flex justify-content-start flex-wrap gap-3 p-3 px-5 photo-section-wrapper">
                                <img src="https://m.media-amazon.com/images/I/61Rx9tHudUL._AC_UF1000,1000_QL80_.jpg"
                                    class="rounded-5 border-red" alt="">
                                <img src="https://m.media-amazon.com/images/I/61Rx9tHudUL._AC_UF1000,1000_QL80_.jpg"
                                    class="rounded-5 border-blue" alt="">
                                <img src="https://m.media-amazon.com/images/I/61Rx9tHudUL._AC_UF1000,1000_QL80_.jpg"
                                    class="rounded-5 border-gray" alt="">
                            </div>
                        </div>

                    </div>
                    <!-- Tab 3 Content -- Attachements  -->
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="d-flex justify-content-start gap-2 p-2">
                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-solid fa-plus text-success me-2"></i> Add Validated Title
                            </button>
                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-solid fa-print text-success me-2"></i> Print
                            </button>
                        </div>

                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-3">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        File Name</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        File Type</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Addes Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tab 4 Content -- Messages -->
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <div class="d-flex justify-content-between p-2 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                    <i class="fa-regular fa-envelope text-success me-2"></i> Send Message
                                </button>
                                <button type="button" class="btn btn-sm  btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-fa-envelope-open text-warning "></i> Mark Message As Read
                                </button>
                                <button type="button" class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                    <i class="fa-regular fa-pen-to-square text-warning"></i> Modify My Last Message
                                </button>
                            </div>

                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-regular fa-trash-can text-danger me-2"></i> Delete Last Message
                            </button>
                        </div>
                    </div>
                    <!-- Tab 5 Content -- California Cover Letter -->
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="d-flex justify-content-start gap-2 p-2">
                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-solid fa-plus text-success me-2"></i> Add Cover Letter
                            </button>
                        </div>

                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-3">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Exporter Name</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Vin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tab 6 Content -- Washington Cover Letter -->
                    <div class="tab-pane fade" id="tab6" role="tabpanel">
                        <div class="d-flex justify-content-start gap-2 p-2">
                            <button type="button" class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-solid fa-plus text-success me-2"></i> Add Washington Cover Letter
                            </button>
                        </div>

                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-3">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Exporter Name</th>
                                    <th scope="col"
                                        style="border: 1px solid #80808082; padding: 5px 15px !important; verticle-align: middle">
                                        Vin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4">500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        {{-- End Lowe Card --}}
    </div>

    <div class="modal fade" id="modal-overlay">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div id="preloader" class="overlay" style="display: none;">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-overlay-title"></h4>
                        <button type="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="p-2 rounded-0">

                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div>
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <select class="btn btn-light btn-sm px-4 rounded-0" name="company"
                                        data-control="select2" data-placeholder="Company" data-allow-clear="true"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true"
                                        style="height: 32px; display: flex; align-items: center;">
                                    </select>
                                </div>

                                <input type="search" class="btn btn-white btn-sm px-4 reounded-0 text-start ms-1"
                                    placeholder="Search" style="width: 200px; border: 1px solid #d3d3d3bd" />
                            </div>

                            <p class="fw-bold">
                                Total: <span class="text-warning">100</span> Vehicle
                            </p>
                        </div>

                    </div>
                    <!--begin::Form-->
                    <div class="modal-body">

                            <table class="table table-hover vehicle-page-tables table-striped-columns mt-0">
                                <thead>
                                    <tr class="bg-light">
                                        <th scope="col"
                                            style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                            Vehicle Name</th>
                                        <th scope="col"
                                            style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                            Color</th>
                                        <th scope="col"
                                            style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                            Port</th>
                                            <th scope="col"
                                            style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                            Title</th>
                                            <th scope="col"
                                            style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                            Key</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>
                                        <td class="p-1 px-4"><i class="fa-solid fa-square-xmark text-danger"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4">Vehicles with Title</td>
                                        <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>
                                        <td class="p-1 px-4"><i class="fa-solid fa-square-xmark text-danger"></i></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    <div class="modal-footer justify-content-navbar">
                            <button type="button" type="button" class="btn btn-custom-discard" data-dismiss="modal"><i
                                    class="fa-solid fa-ban"></i> @lang('view.discard')</button>
                            <button type="button" type="button" class="btn btn-custom-save" data-dismiss="modal" id="form_submit"><i
                                    class="fa-regular fa-floppy-disk"></i> @lang('view.create')</button>
                        </div>
                    <!--end::Form-->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>



@endsection
