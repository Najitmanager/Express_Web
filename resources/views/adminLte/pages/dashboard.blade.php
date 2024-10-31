<x-base-layout>

    <div class="card  table-card-wrapper mx-1">

        {{-- start page title --}}
        <div class="table-header card-header">

            <div class="custom-title">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </div>

        </div>
        {{-- end page title --}}

        <div class="row p-2">
            <div class="col-lg-8">
                <div class="row">
                    {{-- Cards --}}
                    @if (app('hook')->get('dashboard_count'))
                        @foreach (app('hook')->get('dashboard_count') as $componentView)
                            {!! $componentView !!}
                        @endforeach
                    @endif
                    {{-- Chart --}}

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card  vehicle-detail-card my-0 " style="max-height: 100%; height: calc(100% - 15px);">

                    <div class="vehicle-card-header px-3">
                        <span class="custom-title text-light">
                            Quick Access
                        </span>
                    </div>

                    <div class="card-body pb-0 pt-2 pl-2 max-height-card">

                        <table class="table table-hover vehicle-page-tables mt-3">
                            <tbody>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title</td>
                                    <td class="p-1 px-4 text-danger fw-bold">{{ count(get_vehicles()) }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles without Title</td>
                                    <td class="p-1 px-4 text-danger fw-bold">0</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Load Plans</td>
                                    <td class="p-1 px-4 text-danger fw-bold">0</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles without Load Plans</td>
                                    <td class="p-1 px-4 text-danger fw-bold">{{ count(get_vehicles()) }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1 px-4">Vehicles with Title not in Load Plan</td>
                                    <td class="p-1 px-4 text-danger fw-bold">{{ count(get_vehicles()) }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card  vehicle-detail-card my-0 ">

                    <div class="vehicle-card-header px-3">
                        <span class="custom-title text-light">
                            <i class="fa-solid fa-bell text-light me-2"></i> Notifications
                        </span>
                    </div>

                    <div class="card-body p-0 max-height-card">
                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-0">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Vehicle Name</th>
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Status</th>
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Delay</th>
                                </tr>
                            </thead>
                            <tbody>
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Title</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles without Title</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Load Plans</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card  vehicle-detail-card my-0 ">

                    <div class="vehicle-card-header px-3">
                        <span class="custom-title text-light">
                            <i class="fa-solid fa-bell text-light me-2"></i> Need Attention
                        </span>
                    </div>

                    <div class="card-body p-0 max-height-card">

                        <table class="table table-hover vehicle-page-tables table-striped-columns mt-0">
                            <thead>
                                <tr class="bg-light">
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Vehicle Name</th>
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Status</th>
                                    <th scope="col"
                                        style="border: 1px solid #8080805e; padding: 5px 15px !important; verticle-align: middle">
                                        Delay</th>
                                </tr>
                            </thead>
                            <tbody>
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Title</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles without Title</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="p-1 px-4">Vehicles with Load Plans</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                    <td class="p-1 px-4 text-danger fw-bold">500</td>--}}
{{--                                </tr>--}}
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>


    </div>


</x-base-layout>
