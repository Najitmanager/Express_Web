{{-- @php
    $user_role = auth()->user()->role;
    $admin  = 1;
    $staff  = 0;
    $branch = 3;
    $client = 4;
    $driver = 5;

    if($user_role == $admin || $user_role == $staff){
        if($user_role == $admin || auth()->user()->can('manage-branches')){
            $all_branchs   = Modules\Cargo\Entities\Branch::where('is_archived', 0)->count();
        }
        if($user_role == $admin || auth()->user()->can('manage-staffs')){
            $all_staff     = Modules\Cargo\Entities\Staff::count();
        }
        if($user_role == $admin || auth()->user()->can('manage-customers')){
            $all_clients   = Modules\Cargo\Entities\Client::where('is_archived', 0)->count();
        }
        if($user_role == $admin || auth()->user()->can('manage-drivers')){
            $all_captains  = Modules\Cargo\Entities\Driver::where('is_archived', 0)->count();
        }
    }elseif($user_role == $branch){
        $branch_id = Modules\Cargo\Entities\Branch::where('user_id',auth()->user()->id)->pluck('id')->first();

        $all_clients   = Modules\Cargo\Entities\Client::where('is_archived', 0)->where('branch_id',$branch_id)->count();
        $all_captains  = Modules\Cargo\Entities\Driver::where('is_archived', 0)->where('branch_id',$branch_id)->count();
        $all_staff     = Modules\Cargo\Entities\Staff::where('branch_id',$branch_id)->count();
    }
    

@endphp

@if ($user_role == $admin || auth()->user()->can('manage-branches'))
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$all_branchs}}</h3>
                <p>{{ __('cargo::view.all_branches') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <a href="{{ route('branches.index') }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
@endif

@if (in_array($user_role, [$admin, $branch]) || auth()->user()->can('manage-staffs'))
    <div class= @if ($user_role == $admin)"col-xl-3 col-6" @else "col-xl-4 col-6"@endif >
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$all_staff}}</h3>
                <p>{{ __('cargo::view.all_staffs') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('staffs.index') }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
@endif

@if (in_array($user_role, [$admin, $branch]) || auth()->user()->can('manage-customers'))
    <div class= @if ($user_role == $admin)"col-xl-3 col-6" @else "col-xl-4 col-6"@endif>
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$all_clients}}</h3>
                <p>{{ __('cargo::view.all_clients') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-friends"></i>
            </div>
            <a href="{{ route('clients.index') }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
@endif

@if (in_array($user_role, [$admin, $branch]) || auth()->user()->can('manage-drivers'))
    <div class= @if ($user_role == $admin)"col-xl-3 col-6" @else "col-xl-4 col-6"@endif>
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$all_captains}}</h3>
                <p>{{ __('cargo::view.all_drivers') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-people-carry"></i>
            </div>
            <a href="{{ route('drivers.index') }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
@endif

@if ($user_role == $admin || auth()->user()->can('manage-missions') || auth()->user()->can('manage-shipments'))

    @php
        $all_shipments       = Modules\Cargo\Entities\Shipment::count();
        $pending_shipments   = Modules\Cargo\Entities\Shipment::whereIn('status_id', [Modules\Cargo\Entities\Shipment::REQUESTED_STATUS, Modules\Cargo\Entities\Shipment::CAPTAIN_ASSIGNED_STATUS, Modules\Cargo\Entities\Shipment::RECIVED_STATUS, Modules\Cargo\Entities\Shipment::RETURNED_STOCK])->count();
        $delivered_shipments = Modules\Cargo\Entities\Shipment::whereIn('status_id', [Modules\Cargo\Entities\Shipment::DELIVERED_STATUS, Modules\Cargo\Entities\Shipment::SUPPLIED_STATUS, Modules\Cargo\Entities\Shipment::RETURNED_CLIENT_GIVEN])->count();

        $all_missions        = Modules\Cargo\Entities\Mission::count();
        $pending_missions    = Modules\Cargo\Entities\Mission::whereIn('status_id',[ Modules\Cargo\Entities\Mission::REQUESTED_STATUS, Modules\Cargo\Entities\Mission::APPROVED_STATUS, Modules\Cargo\Entities\Mission::RECIVED_STATUS])->count();
        $pickup_missions     = Modules\Cargo\Entities\Mission::where('type', Modules\Cargo\Entities\Mission::PICKUP_TYPE )->count();
        $delivery_missions   = Modules\Cargo\Entities\Mission::where('type', Modules\Cargo\Entities\Mission::DELIVERY_TYPE )->count();
        $transfer_missions   = Modules\Cargo\Entities\Mission::where('type', Modules\Cargo\Entities\Mission::TRANSFER_TYPE )->count();
        $supply_missions     = Modules\Cargo\Entities\Mission::where('type', Modules\Cargo\Entities\Mission::SUPPLY_TYPE )->count();
    @endphp

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$all_shipments}}</h3>
                <p>{{ __('cargo::view.all_Shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index') }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$pending_shipments}}</h3>
                <p>{{ __('cargo::view.pending_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['status'=>[ Modules\Cargo\Entities\Shipment::REQUESTED_STATUS,Modules\Cargo\Entities\Shipment::CAPTAIN_ASSIGNED_STATUS,Modules\Cargo\Entities\Shipment::RETURNED_STOCK,Modules\Cargo\Entities\Shipment::RECIVED_STATUS ] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$delivered_shipments}}</h3>
                <p>{{ __('cargo::view.delivered_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['status'=>[ Modules\Cargo\Entities\Shipment::RETURNED_CLIENT_GIVEN,Modules\Cargo\Entities\Shipment::SUPPLIED_STATUS,Modules\Cargo\Entities\Shipment::DELIVERED_STATUS ] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$all_missions}}</h3>
                <p>{{ __('cargo::view.all_missions') }}</p>
            </div>
            <div class="icon">
            <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index' , ['status' => 'all']) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$pending_missions}}</h3>
                <p>{{ __('cargo::view.pending_missions') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index' , ['status' => [Modules\Cargo\Entities\Mission::REQUESTED_STATUS,Modules\Cargo\Entities\Mission::APPROVED_STATUS,Modules\Cargo\Entities\Mission::RECIVED_STATUS] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$pickup_missions}}</h3>
                <p>{{ __('cargo::view.pickup_missions') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index', ['type' => [Modules\Cargo\Entities\Mission::PICKUP_TYPE] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$delivery_missions}}</h3>
                <p>{{ __('cargo::view.delivery_missions') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index', ['type' => [Modules\Cargo\Entities\Mission::DELIVERY_TYPE] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$transfer_missions}}</h3>
                <p>{{ __('cargo::view.transfer_missions') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index', ['type' => [Modules\Cargo\Entities\Mission::TRANSFER_TYPE] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$supply_missions}}</h3>
                <p>{{ __('cargo::view.supply_missions') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <a href="{{ route('missions.index', ['type' => [Modules\Cargo\Entities\Mission::SUPPLY_TYPE] ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

@elseif($user_role == $branch)

    @php
        $all_shipments       = Modules\Cargo\Entities\Shipment::where('branch_id', $branch_id)->count();
        $pending_shipments   = Modules\Cargo\Entities\Shipment::where('branch_id', $branch_id)->whereIn('status_id', [Modules\Cargo\Entities\Shipment::REQUESTED_STATUS, Modules\Cargo\Entities\Shipment::CAPTAIN_ASSIGNED_STATUS, Modules\Cargo\Entities\Shipment::RECIVED_STATUS, Modules\Cargo\Entities\Shipment::RETURNED_STOCK])->count();
        $delivered_shipments = Modules\Cargo\Entities\Shipment::where('branch_id', $branch_id)->whereIn('status_id', [Modules\Cargo\Entities\Shipment::DELIVERED_STATUS, Modules\Cargo\Entities\Shipment::SUPPLIED_STATUS, Modules\Cargo\Entities\Shipment::RETURNED_CLIENT_GIVEN])->count();
    @endphp

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$all_shipments}}</h3>
                <p>{{ __('cargo::view.all_Shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index',['branch_id' => $branch_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$pending_shipments}}</h3>
                <p>{{ __('cargo::view.pending_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['status'=>[ Modules\Cargo\Entities\Shipment::REQUESTED_STATUS,Modules\Cargo\Entities\Shipment::CAPTAIN_ASSIGNED_STATUS,Modules\Cargo\Entities\Shipment::RETURNED_STOCK,Modules\Cargo\Entities\Shipment::RECIVED_STATUS ] , 'branch_id' => $branch_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$delivered_shipments}}</h3>
                <p>{{ __('cargo::view.delivered_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['status'=>[ Modules\Cargo\Entities\Shipment::RETURNED_CLIENT_GIVEN,Modules\Cargo\Entities\Shipment::SUPPLIED_STATUS,Modules\Cargo\Entities\Shipment::DELIVERED_STATUS ] , 'branch_id' => $branch_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
@elseif($user_role == $client)

    @php
        $client_id = Modules\Cargo\Entities\Client::where('user_id',auth()->user()->id)->pluck('id')->first();
        $all_client_shipments          = Modules\Cargo\Entities\Shipment::where('client_id', $client_id )->count();
        $saved_client_shipments        = Modules\Cargo\Entities\Shipment::where('client_id', $client_id )->where('status_id', Modules\Cargo\Entities\Shipment::SAVED_STATUS)->count();
        $in_progress_client_shipments  = Modules\Cargo\Entities\Shipment::where('client_id', $client_id )->where('client_status', Modules\Cargo\Entities\Shipment::CLIENT_STATUS_IN_PROCESSING)->count();
        $delivered_client_shipments    = Modules\Cargo\Entities\Shipment::where('client_id', $client_id )->where('client_status', Modules\Cargo\Entities\Shipment::CLIENT_STATUS_DELIVERED)->count();

        $transactions                  = Modules\Cargo\Entities\Transaction::where('client_id', $client_id )->orderBy('created_at','desc')->sum('value');
        $DEBIT_transactions            = Modules\Cargo\Entities\Transaction::where('client_id', $client_id )->where('value', 'like', '%-%')->orderBy('created_at','desc')->sum('value'); 
        $CREDIT_transactions           = Modules\Cargo\Entities\Transaction::where('client_id', $client_id )->where('value', 'not like', '%-%')->orderBy('created_at','desc')->sum('value');
        
        // DEBIT  -
        // CREDIT  +
    @endphp

    <div class="col-lg-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <a href="{{ route('transactions.index') }}" class="mb-0 font-weight-bold text-light-75 text-hover-primary font-size-h5">{{ __('cargo::view.your_wallet') }}
                    <div class="font-weight-bold text-success mt-2">{{format_price($CREDIT_transactions)}}</div>
                    <div class="font-weight-bold text-danger mt-3">{{format_price($DEBIT_transactions)}}</div>
                    <div style="width: 15%;height: 1px;background-color: #3f4254;margin-top: 9px;"></div>
                    <div class="mb-3 font-weight-bold text-success mt-4">{{format_price($transactions)}}</div>
                </a>
                <p class="m-0 text-dark-75 font-weight-bolder font-size-h5">{{ __('cargo::view.client_wallet_dashboard') }}.</p>
                
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$all_client_shipments}}</h3>
                <p>{{ __('cargo::view.all_Shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['client_id' => $client_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$saved_client_shipments}}</h3>
                <p>{{ __('cargo::view.saved_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['status'=>[ Modules\Cargo\Entities\Shipment::SAVED_STATUS]  , 'client_id' => $client_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$in_progress_client_shipments}}</h3>
                <p>{{ __('cargo::view.in_progress_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['client_status'=>[ Modules\Cargo\Entities\Shipment::CLIENT_STATUS_IN_PROCESSING] , 'client_id' => $client_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$delivered_client_shipments}}</h3>
                <p>{{ __('cargo::view.delivered_shipments') }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-box-open"></i>
            </div>
            <a href="{{ route('shipments.index', ['client_status'=>[ Modules\Cargo\Entities\Shipment::CLIENT_STATUS_DELIVERED] , 'client_id' => $client_id ]) }}" class="small-box-footer">{{ __('cargo::view.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

@elseif($user_role == $driver)

    @php
        $driver_id    = Modules\Cargo\Entities\Driver::where('user_id',auth()->user()->id)->pluck('id')->first();
        $transactions = Modules\Cargo\Entities\Transaction::where('captain_id', $driver_id)->orderBy('created_at','desc')->sum('value');
        $transactions = abs($transactions); // Converting the transactions from negative to positive
    @endphp

    <div class="col-lg-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <a href="{{ route('transactions.index') }}" class="mb-0 font-weight-bold text-light-75 text-hover-primary font-size-h5">{{ __('cargo::view.your_wallet') }}
                    <div class="mt-0 mb-5 font-weight-bold font-size-h4 text-success mt-9">{{format_price($transactions)}}</div>
                </a>
                <p class="m-0 text-dark-75 font-weight-bolder font-size-h5">{{ __('cargo::view.driver_wallet_dashboard') }}.</p>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
@endif --}}





<div class="col-md-4 mb-1">
    <!-- small box -->
    <div class="custom-dashboard-widget custom-bg-danger">
        <img src="https://express.nejoum.net/resources/workflow-icons/icons8-new-80.png" alt="">
        <div class="widget-text text-center" style="margin-inline-end: 24%;">
            <h1 class="m-0 text-light">1219</h1>
            <h6 class="text-light">New Vehicles</h6>
        </div>
    </div>
</div>

<div class="col-md-4 mb-1">
    <div class="custom-dashboard-widget custom-bg-warning">
        <img src="https://express.nejoum.net/resources/workflow-icons/icons8-warehouse-100.png" alt="">
        <div class="widget-text text-center" style="margin-inline-end: 24%;">
            <h1 class="m-0 text-dark">656</h1>
            <h6 class="text-dark">In Warehouse</h6>
        </div>
    </div>

</div>

<div class="col-md-4 mb-1">
    <div class="custom-dashboard-widget custom-bg-blue">
        <img src="https://express.nejoum.net/resources/workflow-icons/icons8-sent-200.png" alt="">
        <div class="widget-text text-center" style="margin-inline-end: 24%;">
            <h1 class="m-0 text-light">1657</h1>
            <h6 class="text-light">Shipped</h6>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-md-12">
    <div class="card  vehicle-detail-card">

        <div class="vehicle-card-header">
            <span class="custom-title text-light">
                Arrived & Shipped Vehicles each month
            </span>
        </div>

        <div class="card-body p-0 pb-0 pt-0 border-1">
            <div class="chart">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="barChart"
                    style="min-height: 250px; max-width: 100%; display: block; width: 861px;"
                    width="861" height="400" class="chartjs-render-monitor"></canvas>
            </div>
        </div>

    </div>

</div>
@section('scripts')
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */


            var areaChartData = {
                labels: ['01-30 Oct, 2024', 'Sep 2024', 'Aug 2024', 'Jul 2024', 'Jun 2024', 'May 2024',
                    'Apr 2024', 'Mar 2024', 'Feb 2024', 'Jan 2024', 'Dec 2023', 'Nov 2023', 'Oct 2023'
                ],
                datasets: [{
                        label: 'Shipped',
                        backgroundColor: '#417fb8',
                        borderColor: '#417fb8',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: '#24639d',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#24639d',
                        data: [1700, 1400, 2000, 1800, 2200, 2300, 2200, 2550, 2530, 2500, 1990, 2020, 2300]
                    },
                    {
                        label: 'Arrived',
                        backgroundColor: '#a9be3b',
                        borderColor: '#a9be3b',
                        pointRadius: false,
                        pointColor: '#a9be3b',
                        pointStrokeColor: '#a9be3b',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#a9be3b',
                        data: [1600, 1500, 1800, 1300, 2400, 1800, 2800, 2150, 2030, 2100, 1790, 2320, 2400]

                    },
                ],
                options: {
                    scales: {
                        xAxes: [{
                            font: {
                                style: 'normal' // or 'bold' if you want bold labels
                            }
                        }]
                    }
                }
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        })
    </script>
@endsection
