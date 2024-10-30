@extends('warehouse::adminLte.layouts.master')

@section('content')
    <!--begin::Card-->
    <div class="card  table-card-wrapper">

        {{-- start page title --}}
        <div class="table-header card-header">

            <div class="custom-title">
                {{ $model->vin }}
            </div>

        </div>
        {{-- end page title --}}

        <div class="row px-3">
            <div class="col-lg-3 col-md-4">

                {{-- Vehicle Info --}}
                <div class="card  vehicle-detail-card  mb-0 ">

                    <div class="vehicle-card-header">
                        <span class="custom-title text-light">
                            {{ __('warehouse::view.Vehicle Info') }}
                        </span>

                        <button class="btn btn-light btn-sm px-4 rounded-0">
                            <i class="fas fa-edit fa-fw text-warning"></i> {{ __('warehouse::view.Edit Info') }}
                        </button>
                    </div>

                    <div class="card-body pb-0 pt-2 pl-2 max-height-card">
                        <h5 class="text-center mb-1" style="font-weight: 700">{{ $model->name }}</h5>
                        <h6 class="text-center mb-1"> {{ $model->vin }} </h6>
                        <h5 class="text-center mb-1" style="font-weight: 600"> <span style="background-color: {{ optional($model->color)->name }}"> {{ !is_null($model->color) ? $model->color->name : "--------"  }}</span> | {{ !is_null($model->price) ? "$".$model->price : "--------"  }} | {{ !is_null($model->weight) ? $model->weight." KG" : "--------"  }}  </h5>

                        <table class="table table-hover vehicle-page-tables mt-3">
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.table.lot') }}</td>
                                    <td class="p-1 px-4">{{ $model->lot }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Added Date (Utc)') }}</td>
                                    <td class="p-1 px-4">{{ $model->created_at->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Expected Arrival') }}</td>
                                    <td class="p-1 px-4">{{ $model->expected_arrival_date }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Shipping to (Port)') }}</td>
                                    <td class="p-1 px-4">{{ optional($model->port)->name }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Warehouse') }}</td>
                                    <td class="p-1 px-4">{{ optional($model->branch)->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="col-lg-9 col-md-8">
                <div class="row">

                    <div class="col-md-12">
                        {{-- Progress Info Section --}}
                        <div class="card  vehicle-detail-card  mb-0">

                            <div class="vehicle-card-header justify-content-start">
                                <span class="custom-title text-light">
                                    {{ __('warehouse::view.Progress Tracking') }}
                                </span>
                            </div>

                            <div class="card-body p-0 pb-0 pt-0 progress-tracking-status">
                                <div id="panel-2418-body" data-ref="body"
                                    class="x-panel-body x-panel-body-default x-panel-body-default x-scroller x-noborder-t x-panel-default-outer-border-rbl"
                                    role="presentation" style="overflow: hidden; width: 1080px; height: 106px;left: 0px; top: 44px;">
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
                                                        class="step_name">{{ __('warehouse::view.New Vehicle') }}</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="1" data-recordid="4877"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">{{ __('warehouse::view.Arrived') }}</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__1 step_line_done__true"
                                                    data-recordindex="2" data-recordid="4878"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">{{ __('warehouse::view.Pictures Added') }}</span></div>
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
                                               {{ __('warehouse::view.Customer Info') }}
                                            </span>
                                        </div>

                                        <div class="card-body p-0 pb-0 pt-0 max-height-132">
                                            <table class="table table-hover vehicle-page-tables">
                                                <tbody>
                                                    <tr>
                                                        <td class="p-1 px-4">{{ __('warehouse::view.Full Name') }}</td>
                                                        <td class="p-1 px-4">
                                                            {{ $model->client->contact_full_name }} <br>
                                                            {{ $model->client->user->name }}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">{{ __('warehouse::view.Full Address') }}</td>
                                                        <td class="p-1 px-4">{{ $model->client->full_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">{{ __('warehouse::view.phones') }}</td>
                                                        <td class="p-1 px-4">{{ $model->client->phones }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-1 px-4">{{ __('warehouse::view.email') }}</td>
                                                        <td class="p-1 px-4">{{ $model->client->email }}</td>
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
                                                {{ __('warehouse::view.Notes') }}
                                            </span>

                                            <button class="btn btn-light btn-sm px-4 rounded-0">
                                                <i class="fas fa-edit fa-fw text-warning"></i> {{ __('warehouse::view.Notes') }}
                                            </button>

                                        </div>

                                        <div class="card-body p-0 pb-0 pt-0 border-1 max-height-132">
                                            @if($model->public_notes)
                                                <span>  {{ __('warehouse::view.public_notes') }} </span>
                                                <p>
                                                    {{ $model->public_notes }}
                                                </p>
                                            @endif
                                                @if($model->private_notes)
                                                <span>  {{ __('warehouse::view.private_notes') }} </span>
                                                <p>
                                                    {{ $model->private_notes }}
                                                </p>
                                            @endif
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
                            {{ __('warehouse::view.Workflow Info') }}
                        </span>

                        <div class="btn-group" role="group" aria-label="Actions">
                            <button type="button" class="btn btn-light btn-sm px-4 rounded-0" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-bars text-success"></i> __('view.action')
                            </button>
                            <div class="dropdown-menu custom-drodown-content" aria-labelledby="dropdownMenuButton">
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fas fa-edit fa-fw text-warning"></i> {{ __('view.edit') }}
                                    </a>
                                </div>
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fa-solid fa-file text-success"></i> {{ __('warehouse::view.Open Dock Receipt') }}
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
                           {{ __('warehouse::view.Vehicle Photos') }} ({{ $model->total_photos_no }})
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
                                        <i class="fa-solid fa-bars text-success"></i> {{ __('view.action') }}
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
                            @if($model->getFirstMediaUrl('main'))
                                <img src="{{ $model->getFirstMediaUrl('main') }}"
                                     class="rounded-5 border-red" alt="">
                            @endif
                            @if($model->getFirstMediaUrl('bill_of_lading'))
                                <img src="{{$model->getFirstMediaUrl('bill_of_lading')}}"
                                     class="rounded-5 border-blue" alt="">
                            @endif
                                @foreach($model->getMedia('photos') as $photo)
                                    <img src="{{ $photo->getUrl() }}"
                                         class="rounded-5 border-gray" alt="">
                                @endforeach
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@endsection
