@php

    $user_role = auth()->user()->role;

    $admin = 1;
    $auth_staff = 0;
    $auth_branch = 3;
    $auth_client = 4;
    $auth_dilver = 5;
@endphp


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="height: 65px">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        {{--        <li class="nav-item d-sm-inline-block mobile_section"> --}}
        {{--            <a href="{{ fr_route('/') }}" target="_blank" --}}
        {{--                class="nav-link {{ active_route('/') }}">@lang('view.website')</a> --}}
        {{--        </li> --}}

        {{--        @if (check_module('Cargo')) --}}
        {{--            @if ($user_role == $auth_branch || $user_role == $auth_client || auth()->user()->can('create-shipments')) --}}
        {{--            <li class="nav-item d-sm-inline-block mobile_section"> --}}
        {{--                <a href="{{ LaravelLocalization::localizeUrl(route('shipments.create')) }}" --}}
        {{--                    class="nav-link {{ active_route('shipments.create') }}">{{ __('cargo::view.create_new_shipment') }}</a> --}}
        {{--            </li> --}}
        {{--            @endif --}}
        {{--        @endif --}}
    </ul>


    <div class="form-inline ml-0 ml-md-2 d-none d-md-block">
        <div class="input-group input-group-append">
            <input type="search" id="carSearch" aria-label="Search" class="form-control" style="height: 30px"
                placeholder="Search for Vehicle..." autocomplete="off">
            <ul id="searchResults"></ul>

        </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto d-flex align-items-center">

        <!-- Navbar Search -->
        {{--        <li class="nav-item"> --}}
        {{--            <a class="nav-link" data-widget="navbar-search" href="#" role="button"> --}}
        {{--                <i class="fas fa-search"></i> --}}
        {{--            </a> --}}
        {{--            <div class="navbar-search-block"> --}}
        {{--                <form class="form-inline"> --}}
        {{--                    <div class="input-group input-group-sm"> --}}
        {{--                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search"> --}}
        {{--                        <div class="input-group-append"> --}}
        {{--                        <button class="btn btn-navbar" type="submit"> --}}
        {{--                            <i class="fas fa-search"></i> --}}
        {{--                        </button> --}}
        {{--                        <button class="btn btn-navbar" type="button" data-widget="navbar-search"> --}}
        {{--                            <i class="fas fa-times"></i> --}}
        {{--                        </button> --}}
        {{--                        </div> --}}
        {{--                    </div> --}}
        {{--                </form> --}}
        {{--            </div> --}}
        {{--        </li> --}}

        <!-- Notifications Dropdown Menu -->
        {{--        <li class="nav-item dropdown"> --}}
        {{--            <a class="nav-link" data-toggle="dropdown" href="#"> --}}
        {{--                <i class="far fa-bell"></i> --}}
        {{--                <span --}}
        {{--                    class="badge badge-warning navbar-badge">{{ \Auth::user()->unreadNotifications->count() }}</span> --}}
        {{--            </a> --}}
        {{--            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> --}}
        {{--                @if (\Auth::user()->unreadNotifications->count() > 0) --}}
        {{--                    <span class="dropdown-item dropdown-header">{{ \Auth::user()->unreadNotifications->count() }} --}}
        {{--                        @lang('view.notifications')</span> --}}
        {{--                    <div class="dropdown-divider"></div> --}}
        {{--                    @foreach (\Auth::user()->unreadNotifications as $key => $item) --}}
        {{--                        <a href="{{ route('notification.view', ['id' => $item->id]) }}" class="dropdown-item"> --}}
        {{--                            <i --}}
        {{--                                class="@if ($item->icon) {{ $item->icon }} @else fas fa-bell @endif mr-2"></i> --}}
        {{--                            {{ $item->data['message']['subject'] }} --}}
        {{--                            <span --}}
        {{--                                class="float-right text-muted text-sm ml-2">{{ $item->created_at->diffForHumans(null, null, true) }}</span> --}}
        {{--                        </a> --}}
        {{--                        <div class="dropdown-divider"></div> --}}
        {{--                    @endforeach --}}
        {{--                    <a href="#" class="dropdown-item dropdown-footer">@lang('view.see_all_notifications')</a> --}}
        {{--                @else --}}
        {{--                    <!--begin::Nav--> --}}
        {{--                    <span class="dropdown-item dropdown-header">@lang('view.no_new_notifications')</span> --}}
        {{--                    <div class="dropdown-divider"></div> --}}
        {{--                    <!--end::Nav--> --}}
        {{--                @endif --}}
        {{--            </div> --}}
        {{--        </li> --}}

        <!-- Branch Dropdown Menu -->
        <li class="nav-item dropdown d-none d-md-block">
            <a class="nav-link form-control btn btn-primary btn-sm text-white d-flex align-items-center text-center" data-toggle="dropdown" href="#" style="height: 32px">
                <span >{{ app('hook')->get('warehouse')->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                @foreach (auth()->user()->branches as $branch)
                    <a href="{{ route('warehouse.general-settings.warehouseSwitch', $branch) }}"
                        class="dropdown-item @if (app('hook')->get('warehouse')->id == $branch->id) active @endif">{{ $branch->name }}</a>
                @endforeach
            </div>
        </li>
        <!-- Branch Dropdown Menu -->


        <!-- Settings Dropdown Menu -->
        <li class="nav-item dropdown d-none d-md-block">
            @if (check_module('Localization'))
                <a class="nav-link btn btn-secondary btn-sm mx-2 d-flex align-items-center text-center" data-toggle="dropdown" href="#" style="height: 32px">
                    <i class="fa-solid fa-gear"></i>
                    {{ __('warehouse::view.settings') }}
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    <a class="dropdown-item-navbar" style="color: #404040" href="{{ fr_route('ports.index') }}"
                        class="nav-link {{ areActiveRoutes(['ports.index', 'ports.create', 'ports.edit']) }}">
                        <i class="fas fa-anchor fa-fw"></i>
                        <p class="mb-0">{{ __('warehouse::view.ports') }}</p>
                    </a>
                    <a class="dropdown-item-navbar" style="color: #404040" href="{{ fr_route('carriers.index') }}"
                        class="nav-link {{ areActiveRoutes(['carriers.index', 'carriers.create', 'carriers.edit']) }}">
                        <i class="fas fa-ship fa-fw"></i>
                        <p class="mb-0">{{ __('warehouse::view.carriers') }}</p>
                    </a>
                    <a class="dropdown-item-navbar" style="color: #404040" href="{{ fr_route('consignees.index') }}"
                        class="nav-link {{ areActiveRoutes(['consignees.index', 'consignees.create', 'consignees.edit']) }}">
                        <i class="fa-solid fa-store"></i>
                        <p class="mb-0">{{ __('warehouse::view.consignees') }}</p>
                    </a>
                    <a class="dropdown-item-navbar" style="color: #404040" href="{{ fr_route('users.index') }}"
                        class="nav-link {{ areActiveRoutes(['users.index', 'users.create', 'users.edit']) }}">
                        <i class="fa-solid fa-user-gear"></i>
                        <p class="mb-0">{{ __('users::view.users') }}</p>
                    </a>
                    <a class="dropdown-item-navbar" style="color: #404040" href="{{ fr_route('roles.index') }}"
                        class="nav-link {{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit']) }}">
                        <i class="fa-solid fa-user-lock"></i>
                        <p class="mb-0">{{ __('acl::view.roles') }}</p>
                    </a>
                </div>
            @endif
        </li>



        <!-- Language Dropdown Menu -->
        <li class="nav-item dropdown">
            @if (check_module('Localization'))
                <a class="nav-link btn-sm mx-2 d-flex align-items-center text-center px-0" data-toggle="dropdown" href="#" style="height: 32px">
                    {{--                    @if (Config::get('current_lang_image')) --}}
                    <img src="{{ get_current_lang_image() }}" alt="" class="flag-icon mx-1" />
                    {{--                    @endif --}}
                    <span class="d-none d-md-block">{{ LaravelLocalization::getCurrentLocaleName() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    @foreach (Modules\Localization\Entities\Language::all() as $key => $language)
                        <a href="{{ LaravelLocalization::getLocalizedURL($language->code) }}" class="dropdown-item">
                            @if ($language->imageUrl)
                                <img class="flag-icon mr-2" src="{{ $language->imageUrl }}" alt="" />
                            @endif {{ $language->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </li>
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    <i class="fas fa-user"></i> {{ auth()->user()->user_role }} | {{ auth()->user()->name }}
                </span>
                <div class="dropdown-divider"></div>
                @checkModule('users')
                    {{-- Admin --}}
                    @if ($user_role == $admin)
                        <a href="{{ fr_route('users.show', ['id' => auth()->id()]) }}" class="dropdown-item">
                            @lang('users::view.my_profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('users.edit', ['id' => auth()->id()]) }}" class="dropdown-item">
                            @lang('users::view.account_settings')
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    {{-- client --}}
                    @if ($user_role == $auth_client)
                        @php
                            $item_id = Modules\Cargo\Entities\Client::where('user_id', auth()->user()->id)
                                ->pluck('id')
                                ->first();
                        @endphp

                        <a href="{{ fr_route('clients.show', ['client' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.my_profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('clients.profile', ['id' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.account_settings')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('clients.manage-address') }}" class="dropdown-item">
                            @lang('cargo::view.manage_address')
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    {{-- branch --}}
                    @if ($user_role == $auth_branch)
                        @php
                            $item_id = Modules\Cargo\Entities\Branch::where('user_id', auth()->user()->id)
                                ->pluck('id')
                                ->first();
                        @endphp
                        <a href="{{ fr_route('branches.show', ['branch' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.my_profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('branches.profile', ['id' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.account_settings')
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif


                    {{-- driver --}}
                    @if ($user_role == $auth_dilver)
                        @php
                            $item_id = Modules\Cargo\Entities\Driver::where('user_id', auth()->user()->id)
                                ->pluck('id')
                                ->first();
                        @endphp
                        <a href="{{ fr_route('drivers.show', ['driver' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.my_profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('drivers.profile', ['id' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.account_settings')
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif


                    {{-- staff --}}
                    @if ($user_role == $auth_staff)
                        @php
                            $item_id = Modules\Cargo\Entities\Staff::where('user_id', auth()->user()->id)
                                ->pluck('id')
                                ->first();
                        @endphp
                        <a href="{{ fr_route('staffs.show', ['staff' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.my_profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ fr_route('staffs.profile', ['id' => $item_id]) }}" class="dropdown-item">
                            @lang('users::view.account_settings')
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif
                @endcheckModule
                <form id="formLogout" method="POST" action="{{ fr_route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">@lang('view.sign_out')</button>
                </form>
                <div class="dropdown-divider"></div>
            </div>
            <a class="nav-link btn-sm mx-2 d-flex align-items-center text-center px-0 gap-3" data-toggle="dropdown" href="#" style="height: 32px">
                <span class="d-none d-md-block">{{ auth()->user()->name }}</span>
                <img src="{{ auth()->user()->getFirstMediaUrl('avatar') ? auth()->user()->getFirstMediaUrl('avatar') : asset('assets/lte/media/avatars/user-avatar.png') }}"
                    class="img-circle img-size-32 mr-2" alt="User Image">
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{--         <li class="nav-item"> --}}
        {{--            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button"> --}}
        {{--                <i class="fas fa-th-large"></i> --}}
        {{--            </a> --}}
        {{--        </li> --}}
    </ul>
</nav>
<!-- /.navbar -->

<style>
    @media only screen and (max-width: 600px) {
        .mobile_section {
            display: none !important;
        }
    }
</style>
