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
                                                    class="step step_point_done__1  @if($model->status) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="0" data-recordid="4876"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">New Vehicle</span></div>
                                                <div style="width: 11%;"
                                                    class="step @if($model->status) step_point_done__1 @else step_point_done__0 @endif @if(count($model->getMedia('photos'))) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="1" data-recordid="4877"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Arrived</span></div>
                                            <div style="width: 11%;"
                                                 class="step @if(!count($model->getMedia('photos'))) step_point_done__0 @else step_point_done__1 @endif @if(count($model->getMedia('keys'))) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="2" data-recordid="4878"
                                                    data-boundview="dataview-2419"><span style="line-height: 16px !important; font-size: 18px;" class="step_index fas fa-car-side"></span>
                                                <span class="step_name">
                                                    @if(count($model->getMedia('photos')))
                                                    Pictures Added
                                                    @else
                                                        Pictures
                                                    @endif
                                                </span>
                                            </div>
                                                <div style="width: 11%;"
                                                    class="step @if(!count($model->getMedia('keys'))) step_point_done__0 @else step_point_done__1 @endif @if($model->workflow && $model->workflow->title_number) step_line_done__true @else step_line_done__false @endif "
                                                    data-recordindex="3" data-recordid="4879"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">
                                                        @if(count($model->getMedia('keys')))
                                                            Key Received
                                                        @else
                                                            Without Key
                                                        @endif
                                                    </span></div>
                                                <div style="width: 11%;"
                                                    class="step @if($model->workflow && $model->workflow->title_number) step_point_done__1 @else step_point_done__0 @endif @if($model->dock && $model->dock->booking_received) step_line_done__true @else step_line_done__false @endif "
                                                    data-recordindex="4" data-recordid="4880"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">
                                                        @if($model->workflow && $model->workflow->title_number)
                                                            {{ $model->title_status_name }}
                                                        @else
                                                            No Title
                                                        @endif
                                                    </span></div>
                                                <div style="width: 11%;"
                                                    class="step @if($model->dock && $model->dock->booking_received) step_point_done__1 @else step_point_done__0 @endif @if($model->dock && $model->dock->getMedia('loading_photos')) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="5" data-recordid="4881"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Booking</span></div>
                                                <div style="width: 11%;"
                                                    class="step @if($model->dock && $model->dock->load_plan_received) step_point_done__1 @else step_point_done__0 @endif @if($model->dock && $model->dock->getMedia('loading_photos')) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="6" data-recordid="4882"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">{{ __('warehouse::view.Loading Plan') }}</span></div>
                                                <div style="width: 11%;"
                                                    class="step @if($model->dock && $model->dock->getMedia('loading_photos')) step_point_done__1 @else step_point_done__0 @endif @if($model->status===2) step_line_done__true @else step_line_done__false @endif"
                                                    data-recordindex="7" data-recordid="4883"
                                                    data-boundview="dataview-2419"><span
                                                        style="line-height: 16px !important; font-size: 18px;"
                                                        class="step_index fas fa-car-side"></span><span
                                                        class="step_name">Loading Pictures</span></div>
                                                <div style="width: 11%;"
                                                    class="step step_point_done__0 step_line_done__false"
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
                                                <span>  {{ __('warehouse::view.public_notes') }} :</span>
                                                <p>
                                                    {{ $model->public_notes }}
                                                </p>
                                            @endif
                                                @if($model->private_notes)
                                                <span>  {{ __('warehouse::view.private_notes') }} :</span>
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
                                <i class="fa-solid fa-bars text-success"></i> {{__('view.action')}}
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
                                        <i class="fa-solid fa-key text-success"></i> {{ __('warehouse::view.Confirm Key Received') }}
                                    </a>
                                </div>
                                <div class="vehicle-page-dropdown">
                                    <a href="#" class="btn btn-sm btn-action-table px-3" data-toggle="tooltip"
                                        title="{{ __('view.edit') }}">
                                        <i class="fa-solid fa-file text-success"></i> {{ __('warehouse::view.Confirm Title Received') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 pb-0 pt-0 max-height-card">

                        <table class="table vehicle-page-tables">
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Arrival Date') }}</td>
                                    <td class="p-1 px-4 @if(!$model->workflow && !$model->workflow->arrival_date) bg-danger-400 @endif">
                                        @if(!$model->workflow && !$model->workflow->arrival_date)
                                        <i class="fa-solid fa-circle-xmark text-danger mr-1"></i>
                                        @endif
                                        {{ optional($model->workflow)->arrival_date }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Hat')  }}</td>
                                    <td class="p-1 px-4">  {{ optional($model->workflow)->hat }}  </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Key') }}</td>
                                    <td class="p-1 px-4 @if(!count($model->getMedia('keys'))) bg-warning-400 @else bg-green-400 @endif ">

                                        @if(!count($model->getMedia('keys')))
                                            <i class="fa-solid fa-circle-xmark text-warning mr-1"></i>
                                            {{ __('warehouse::view.Without Key') }}
                                            @else
                                            <i class="fa-solid fa-square-check text-green mr-1"></i>
                                            {{ __('warehouse::view.Have Key') }}
                                        @endif
                                    </td>
                                </tr>
                                @if($model->key_received)
                                    <tr>
                                        <td class="p-1 px-4">{{ __('warehouse::view.Key Received') }}</td>
                                        <td class="p-1 px-4 bg-green-400 ">
                                                <i class="fa-solid fa-circle-check text-green mr-1"></i>
                                                {{ __('warehouse::view.Confirmed') }}

                                        </td>
                                    </tr>
                                @endif
                                @if(count($model->getMedia('keys')))
                                    @foreach($model->getMedia('keys') as $key)
                                        <tr>
                                            <td class="p-1 px-4">{{ __('warehouse::view.Key File') }}</td>
                                            <td class="p-1 px-4  ">
                                                {{ $key->name }}
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif

                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Title') }}</td>
                                    <td class="p-1 px-4 @if($model->workflow && $model->workflow->title_number) bg-success-400 @else bg-danger-400 @endif ">
                                        @if($model->workflow && $model->workflow->title_number)
                                            <i class="fa-solid fa-circle-check text-success mr-1"></i> {{ __('warehouse::view.Have Title') }}
                                        @else
                                            <i class="fa-solid fa-square-xmark text-danger mr-1"></i> {{ __('warehouse::view.No Title') }}
                                        @endif
                                    </td>
                                </tr>

                                @if($model->title_received)
                                    <tr>
                                        <td class="p-1 px-4">{{ __('warehouse::view.Title Received') }}</td>
                                        <td class="p-1 px-4 bg-green-400 ">
                                            <i class="fa-solid fa-circle-check text-green mr-1"></i>
                                            {{ __('warehouse::view.Confirmed') }}

                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Title Number') }}</td>
                                    <td class="p-1 px-4 @if($model->worflow && $model->workflow->title_number) bg-success-400 @else bg-danger-400 @endif ">
                                        @if($model->worflow && $model->workflow->title_number)
                                            <i class="fa-solid fa-circle-check text-success mr-1"></i>{{ $model->workflow->title_number }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Title State') }}</td>
                                    <td class="p-1 px-4 @if(!$model->workflow || $model->workflow->title_status != 2) bg-danger-400 @endif ">
                                        @if($model->workflow && $model->workflow->title_status == 0)
                                            <i class="fa-solid fa-triangle-exclamation  mr-1"></i>
                                        @elseif($model->workflow && $model->workflow->title_status == 1)
                                            <i class="fa-solid fa-square-xmark text-danger mr-1"></i>
                                        @else
                                            <i class="fa-solid fa-square-xmark text-success mr-1"></i>
                                        @endif
                                        {{ optional($model->workflow)->title_status_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.booking_no') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->booking) bg-danger-400 @endif">
                                        {{ optional($model->dock)->booking->booking_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.container_no') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->container_no) bg-danger-400 @endif">
                                        {!! optional($model->dock)->container_url !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Loading Plan') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->load_plan_received) bg-danger-400 @else bg-success-400 @endif">
                                        @if($model->dock && $model->dock->load_plan_received)
                                            <i class="fa-solid fa-circle-check text-green mr-1"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Booking') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->booking_received) bg-danger-400 @else bg-success-400 @endif">
                                        @if($model->dock && $model->dock->booking_received)
                                            <i class="fa-solid fa-circle-check text-green mr-1"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Container Loading Date') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->loading_date) bg-danger-400 @endif">
                                        {{ optional($model->dock)->loading_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">{{ __('warehouse::view.Container Departure Date') }}</td>
                                    <td class="p-1 px-4 @if(!$model->dock && !$model->dock->departure_date) bg-danger-400 @endif">
                                        {{ optional($model->dock)->departure_date }}
                                    </td>
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
                           {{ __('warehouse::view.Vehicle Photos') }} (<span id="photos_no"> {{ $model->total_photos_no }} </span>)
                        </span>

                        <div class="d-inline-flex ml-auto gap-2">
                            <div class="">

                                <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" class="btn btn-light btn-sm px-4 rounded-0">
                                    <i class="fa-solid fa-plus text-success"></i> <span class="d-none d-md-block">Add Photo</span>

                            </div>

                            <div class="">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <button type="button" class="btn btn-light btn-sm px-4 rounded-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-regular fa-image text-success"></i><span class="d-none d-md-block"> Set Photo Type</span>
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
                                        <i class="fa-solid fa-bars text-success"></i> <span class="d-none d-md-block">{{ __('view.action') }}</span>
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
                        <div id="overlay-loader" class="overlay dark" style="display: none;">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>
                        <div class="d-flex justify-content-start flex-wrap gap-3 p-3 px-5 photo-section-wrapper" id="photos-section">
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
@section('scripts')
    <script>
        $(document).ready(function (){
            let csrfToken = '{{ csrf_token() }}';
            $('#imageUpload').on('change', function(event) {
                let formData = new FormData();
                let files = event.target.files;

                // Append each selected file to formData
                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
                formData.append('_token', csrfToken);


                // Send AJAX request
                $.ajax({
                    url: '/upload-photos/'+ {{ $model->id }}, // Replace with your server-side upload URL
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Show preloader before the request starts
                        $('#overlay-loader').show();
                        $('#photo-section').html('')
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Photo added successfully!'
                        })
                        $('#photo-section').html(response['view'])
                        $('#photos_no').html(response['number'])

                    },
                    error: function(xhr, status, error) {
                        Toast.fire({
                            icon: 'error',
                            title: error
                        })
                    },
                    complete: function() {
                    $('#overlay-loader').hide();
                }
                });
            });
        });
    </script>
@endsection
