@extends('warehouse::adminLte.layouts.master')

@section('content')
    <!--begin::Card-->

    <div class="card table-card-wrapper">
        <div class="table-header card-header">

            <div class="custom-title">
                New Dock Reciept
            </div>

        </div>
        <div class="d-flex justify-content-between p-2 flex-wrap gap-2 border-bottom border-secodary">

            <div class="d-flex gap-2 ">
                <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-floppy-disk text-success me-2"></i> Save
                </button>
                <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-floppy-disk text-success me-2"></i> Save & Close
                </button>
                <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                    <i class="fa-solid fa-print text-success me-2"></i> Print
                </button>
            </div>

            <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                <i class="fa-regular fa-circle-xmark text-danger me-2"></i> Print
            </button>
        </div>

        {{-- Start Topper Form --}}
        <div class="card table-card-wrapper dock-page m-3 p-3" style="min-height: auto">
            <div class="row justify-content-between">
                {{-- form left side --}}
                <div class="col-lg-6">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Document No.</label>
                            <input type="text" class="form-control" placeholder="auto">
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Booking No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-lg-4 d-flex justify-content-start align-items-center gap-2">
                            <input type="checkbox">
                            <label for="name" class="form-label mb-1">Load Plan Received</label>
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Container No.</label>
                            <input type="text" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Seal No.</label>
                            <input type="text" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">AES No.</label>
                            <input type="text" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Type Of Move.</label>
                            <input type="text" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Loading/Pier Terminal.</label>
                            <input type="text" class="form-control">

                        </div>
                        <div class="col-lg-4 d-flex justify-content-start align-items-center gap-2">
                            <input type="checkbox">
                            <label for="name" class="form-label mb-1">Booking Reciept.</label>

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Container Loading Date.</label>
                            <input type="date" class="form-control">

                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Container in Gate Date.</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-lg-4 mb-2">
                            <label for="name" class="form-label mb-1">Departure Date.</label>
                            <input type="date" class="form-control">

                        </div>
                    </div>
                </div>
                {{-- form right side --}}
                <div class="col-lg-5">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-12">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Customer: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Consignee: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Botify Party: </label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Trucking Co: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Exporting Carrier: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Vassel Name: </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="name" class="form-label"> Voyage: </label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label for="name" class="form-label"> Port: </label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
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
                        Vehicle List (15)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab2">
                    <a class="nav-link border-0" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">
                        Loading Photos (15)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab3">
                    <a class="nav-link border-0" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">
                        Attachments (15)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab4">
                    <a class="nav-link border-0" id="tab4-tab" data-bs-toggle="tab" href="#tab4" role="tab">
                        Messages (15)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab5">
                    <a class="nav-link border-0" id="tab5-tab" data-bs-toggle="tab" href="#tab5" role="tab">
                        California Cover Letter (15)
                    </a>
                </li>
                <li class="nav-item custom-title tabs-only p-0 ms-2 index-btn" role="presentation" data-href="tab6">
                    <a class="nav-link border-0" id="tab6-tab" data-bs-toggle="tab" href="#tab6" role="tab">
                        Washington Cover Letter (15)
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
                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                            <i class="fa-solid fa-plus text-success me-2"></i> Add vehicle
                        </button>

                        <div class="d-flex align-items-center gap-2">
                            <label for="name" class="form-label mb-0" style="width: 150px !important;"> container
                                size. </label>
                            <select class="form-select form-select-sm">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
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
                            <tr>
                                <td class="p-1 px-4">Vehicles with Title</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">Vehicles with Title</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>
                                <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>
                                <td class="p-1 px-4"><i class="fa-regular fa-pen-to-square text-warning"></i></td>
                                <td class="p-1 px-4"><i class="fa-regular fa-trash-can text-danger"></i></td>
                            </tr>
                            <tr>
                                <td class="p-1 px-4">Vehicles with Title</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">Vehicles with Title</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4">500</td>
                                <td class="p-1 px-4"><i class="fa-solid fa-square-check text-success"></i></td>
                                <td class="p-1 px-4"><i class="fa-solid fa-triangle-exclamation text-warning"></i></td>
                                <td class="p-1 px-4"><i class="fa-regular fa-pen-to-square text-warning"></i></td>
                                <td class="p-1 px-4"><i class="fa-regular fa-trash-can text-danger"></i></td>
                            </tr>
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

                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
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
                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                            <i class="fa-solid fa-plus text-success me-2"></i> Add Validated Title
                        </button>
                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
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
                            <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                                <i class="fa-regular fa-envelope text-success me-2"></i> Send Message
                            </button>
                            <button class="btn btn-sm  btn-light px-3" data-toggle="tooltip">
                                <i class="fa-regular fa-fa-envelope-open text-warning "></i> Mark Message As Read
                            </button>
                            <button class="btn btn-sm btn-light px-3" data-toggle="tooltip">
                                <i class="fa-regular fa-pen-to-square text-warning"></i> Modify My Last Message
                            </button>
                        </div>

                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
                            <i class="fa-regular fa-trash-can text-danger me-2"></i> Delete Last Message
                        </button>
                    </div>
                </div>
                <!-- Tab 5 Content -- California Cover Letter -->
                <div class="tab-pane fade" id="tab5" role="tabpanel">
                    <div class="d-flex justify-content-start gap-2 p-2">
                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
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
                        <button class="btn btn-sm btn-light px-2 d-flex align-items-center">
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

        {{-- End Lowe Card --}}


    </div>
@endsection
