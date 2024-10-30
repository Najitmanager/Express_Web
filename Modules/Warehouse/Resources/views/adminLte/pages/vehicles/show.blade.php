@extends('warehouse::adminLte.layouts.master')

@section('content')
    <!--begin::Card-->
    <div class="card  table-card-wrapper">

        {{-- start page title --}}
        <div class="table-header card-header">

            <div class="custom-title">
                4654645354687
            </div>

        </div>
        {{-- end page title --}}

        <div class="row px-3">
            <div class="col-md-3">

                {{-- Vehicle Info --}}
                <div class="card  vehicle-detail-card  mb-0 ">

                    <div class="vehicle-card-header">
                        <span class="custom-title text-light">
                            Vehicle Info
                        </span>

                        <button class="btn btn-light btn-sm px-4 rounded-0">
                            <i class="fas fa-edit fa-fw text-warning"></i> Edit Info
                        </button>
                    </div>

                    <div class="card-body pb-0 pt-2 pl-2 max-height-card">
                        <h5 class="text-center mb-1" style="font-weight: 700">2017 TOYOTA CAMRY HYBRID</h5>
                        <h6 class="text-center mb-1"> 4T1BD1FKXHU201335 </h6>
                        <h5 class="text-center mb-1" style="font-weight: 600"> White | $2,100.00 | ---------- </h5>

                        <table class="table table-hover vehicle-page-tables mt-3">
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Lot</td>
                                    <td class="p-1 px-4">354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Added Date (Utc)</td>
                                    <td class="p-1 px-4">Red</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Warehouse</td>
                                    <td class="p-1 px-4">New Jersey</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Expected Arrival</td>
                                    <td class="p-1 px-4">354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Shipping to (Port)</td>
                                    <td class="p-1 px-4">354353543</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="col-md-9">
                <div class="row">

                    <div class="col-md-12">
                        {{-- Progress Info Section --}}
                        <div class="card  vehicle-detail-card  mb-0">

                            <div class="vehicle-card-header justify-content-start">
                                <span class="custom-title text-light">
                                    Progress Tracking
                                </span>
                            </div>

                            <div class="card-body p-0 pb-0 pt-0">
                                <div id="panel-2418-body" data-ref="body"
                                    class="x-panel-body x-panel-body-default x-panel-body-default x-scroller x-noborder-t x-panel-default-outer-border-rbl"
                                    role="presentation" style="overflow: auto hidden; width: 1080px; height: 106px;left: 0px; top: 44px;">
                                    <div id="panel-2418-outerCt" data-ref="outerCt" class="x-autocontainer-outerCt"
                                        role="presentation" style="width: 100%; height: 100%;">
                                        <div id="panel-2418-innerCt" data-ref="innerCt" style="" role="presentation"
                                            class="x-autocontainer-innerCt">
                                            <div class="x-component x-ltr x-component-default"
                                            style="padding: 0px 0px 20px; width: 1095px; display: inline-table;"
                                                role="listbox" aria-hidden="false" aria-disabled="false" id="dataview-2419"
                                                tabindex="-1" data-tabindex-value="-1" data-tabindex-counter="1"
                                                data-componentid="dataview-2419">
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="0" data-recordid="4876"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">New Vehicle</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="1" data-recordid="4877"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Arrived</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="2" data-recordid="4878"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Pictures Added</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="3" data-recordid="4879"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Key Received</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="4" data-recordid="4880"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Have Title</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="5" data-recordid="4881"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Booking</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__false"
                                                    data-recordindex="6" data-recordid="4882"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Loading Plan</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__0 step_line_done__false"
                                                    data-recordindex="7" data-recordid="4883"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Loading Pictures</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__false"
                                                    data-recordindex="8" data-recordid="4884"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Shipped</span></div>
                                                <div class="x-tab-guard x-tab-guard-after" tabindex="0"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 p-0">
                            <div class="row">
                                <div class="col-md-5">
                                    {{-- Customer Info --}}
                                    <div class="card  vehicle-detail-card ">

                                        <div class="vehicle-card-header justify-content-start">
                                            <span class="custom-title text-light">
                                                Customer Info
                                            </span>
                                        </div>

                                        <div class="card-body p-0 pb-0 pt-0 max-height-132">
                                            <table class="table table-hover vehicle-page-tables">
                                                <tbody>
                                                    <tr>
                                                        <td class="p-1 px-4">Full Name</td>
                                                        <td class="p-1 px-4">354353543</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">Full Address</td>
                                                        <td class="p-1 px-4">Red</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">Phone</td>
                                                        <td class="p-1 px-4">New Jersey</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">Email</td>
                                                        <td class="p-1 px-4">354353543</td>
                                                    </tr>
                                                    
                                                </tbody>

                                            </table>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-7">
                                    {{-- Notes Section --}}
                                    <div class="card  vehicle-detail-card">

                                        <div class="vehicle-card-header">
                                            <span class="custom-title text-light">
                                                Notes
                                            </span>

                                            <button class="btn btn-light btn-sm px-4 rounded-0">
                                                <i class="fas fa-edit fa-fw text-warning"></i> Edit Note
                                            </button>

                                        </div>

                                        <div class="card-body p-0 pb-0 pt-0 border-1 max-height-132">
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                {{-- Wordflow Info --}}
                <div class="card vehicle-detail-card">

                    <div class="vehicle-card-header">
                        <span class="custom-title text-light">
                            Workflow Info
                        </span>

                        <div class="btn-group" role="group" aria-label="Actions">
                            <button type="button" class="btn btn-light btn-sm px-4 rounded-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-bars text-success"></i> Actions
                            </button>
                            <div class="dropdown-menu custom-drodown-content" aria-labelledby="dropdownMenuButton">
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fas fa-edit fa-fw text-warning"></i> Edit
                                    </a>
                                </div>
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fa-solid fa-file text-success"></i> Open Dock Receipt
                                    </a>
                                </div>
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fa-solid fa-key text-success"></i> Confirm Key Received
                                    </a>
                                </div>
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fa-solid fa-file text-success"></i> Confirm Title Received
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 pb-0 pt-0 max-height-card">

                        <table class="table vehicle-page-tables">
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Full Name</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Full Address</td>
                                    <td class="p-1 px-4 bg-warning-400"> <i
                                            class="fa-solid fa-triangle-exclamation text-warning mr-1"></i> Red</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Phone</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> New Jersey</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-success-400"> <i
                                            class="fa-solid fa-circle-check text-success mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-success-400"> <i
                                            class="fa-solid fa-circle-check text-success mr-1"></i>354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-success-400"> <i
                                            class="fa-solid fa-circle-check text-success mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Email</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Full Name</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> 354353543</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Full Address</td>
                                    <td class="p-1 px-4 bg-warning-400">Red</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Phone</td>
                                    <td class="p-1 px-4 bg-danger-400"> <i
                                            class="fa-solid fa-circle-xmark text-danger mr-1"></i> New Jersey</td>
                                </tr>
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

            <div class="col-md-9">
                {{-- Vehicle Photos --}}
                <div class="card vehicle-detail-card">

                    <div class="vehicle-card-header">
                        <span class="custom-title text-light">
                            Vehicle Photos (12)
                        </span>

                        <div class="d-inline-flex ml-auto gap-2">
                            <div class="">
                                <button type="button" class="btn btn-light btn-sm px-4 rounded-0">
                                    <i class="fa-solid fa-plus text-success"></i> Add Photo
                                </button>
                            </div>

                            <div class="">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" class="btn btn-light btn-sm px-4 rounded-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-regular fa-image text-success"></i> Set Photo Type
                                    </button>
                                    <div class="dropdown-menu custom-drodown-content"
                                        aria-labelledby="dropdownMenuButton">
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-regular fa-image text-danger"></i> Set Main Photo
                                            </a>
                                        </div>
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-regular fa-image text-primary"></i> Set Bill of Lading Photo
                                            </a>
                                        </div>
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-regular fa-image text-secondary"></i> Vehicle Photo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" class="btn btn-light btn-sm px-4 rounded-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-bars text-success"></i> Actions
                                    </button>
                                    <div class="dropdown-menu custom-drodown-content"
                                        aria-labelledby="dropdownMenuButton">
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-regular fa-image text-success"></i> Show Photo Info
                                            </a>
                                        </div>
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-solid fa-download text-success"></i> Download ALl Photos
                                            </a>
                                        </div>
                                        <div class="vehicle-page-dropdown">
                                            <a href="#" class="btn btn-sm btn-action-table px-3"
                                                data-toggle="tooltip" title="{{ __('view.edit') }}">
                                                <i class="fa-solid fa-trash text-danger"></i> Delete Selection
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 pb-0 pt-0">
                        <div class="d-flex justify-content-start flex-wrap gap-3 p-3 px-5 photo-section-wrapper">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-red" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-blue" alt="">
                            <img src="https://express.nejoum.net/api/Files/Thumbnails?fileId=9ZIES558-E3ECFA-B6DF"
                                class="rounded-5 border-gray" alt="">

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
