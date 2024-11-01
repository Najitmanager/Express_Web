<!--begin::Aside-->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="margin-bottom: 30px;">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto brand-link" style="background-color: #35baf6!important;" id="kt_aside_logo">
        <!--begin::Logo-->
        <div  style="display: flex;justify-content: center; gap: 7px;">
            <img src="{{ asset('assets/lte/cargo-logo.gif') }}" alt="Logo" style="height: 38px;" class="logo" />
            <span class="m-1 text-light"> {{ env('APP_NAME') }} </span>
        </div>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <div class="sidebar" >
        <!-- Sidebar user panel (optional) -->
{{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
{{--            <div class="image">--}}
{{--                <img src="{{ auth()->user()->getFirstMediaUrl('avatar')? auth()->user()->getFirstMediaUrl('avatar'): asset('assets/lte/media/avatars/blank.png') }}"--}}
{{--                    class="img-circle elevation-2" alt="User Image">--}}
{{--            </div>--}}
{{--            <div class="info">--}}
{{--                <a href="#" class="d-block">{{ auth()->user()->name }} |--}}
{{--                    <span class="badge {{ auth()->user()->role == 1 ? 'badge-light-success' : 'badge-light-primary' }} fw-bolder fs-8 px-2 py-1 ms-2">--}}
{{--                        {{ auth()->user()->user_role }}--}}
{{--                    </span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!--begin::Aside menu-->
        <nav class="mt-0" style="padding-bottom: 30px !important;">
            <!--begin::Aside Menu-->
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!--begin::Menu-->
                <li class="nav-item">
                    <a href="{{ fr_route('admin.dashboard') }}"
                        class="nav-link {{ areActiveRoutes(['admin.dashboard']) }}">
                        <i class="nav-icon fas fa-house-chimney"></i>
                        <p>
                            @lang('view.home')
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-header">@lang('view.warehouse')</li> --}}



                @if (app('hook')->get('aside_menu'))
                    @foreach (aasort(app('hook')->get('aside_menu'), 'order') as $componentView)
                        {!! $componentView !!}
                    @endforeach
                @endif

{{--                <li--}}
{{--                    class="nav-item {{ areActiveRoutes(['shipments.report','missions.report','clients.report','drivers.report','branches.report','transactions.report'],'menu-is-opening menu-open active') }}">--}}

{{--                    <a href="#"--}}
{{--                        class="nav-link  {{ areActiveRoutes(['shipments.report','missions.report','clients.report','drivers.report','branches.report','transactions.report'],'menu-is-opening menu-open active') }}">--}}
{{--                        <i class="fas fa-book fa-fw"></i>--}}
{{--                        <p>--}}
{{--                            {{ __('view.reports') }}--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}


{{--                    <ul class="nav nav-treeview">--}}
{{--                        @if (app('hook')->get('aside_menu_reports'))--}}
{{--                            @foreach (app('hook')->get('aside_menu_reports') as $componentView)--}}
{{--                                {!! $componentView !!}--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </ul>--}}

{{--                </li>--}}


{{--                <li class="nav-item {{ areActiveRoutes(['countries.index','areas.index','deliveryTime.index','packages.index','shipments.settings.fees','shipments.settings','admin.settings','admin.settings.notifications','theme-setting.edit','languages.index','currencies.index','shipments.index','fees.index','admin.settings.google','default-theme.edit'],'menu-is-opening menu-open active') }}">--}}

{{--                    <a href="#"--}}
{{--                        class="nav-link  {{ areActiveRoutes(['countries.index','areas.index','deliveryTime.index','packages.index','shipments.settings.fees','shipments.settings','admin.settings','admin.settings.notifications','theme-setting.edit','languages.index','currencies.index','shipments.index','fees.index','admin.settings.google','default-theme.edit'],'menu-is-opening menu-open active') }}">--}}
{{--                        <i class="fas fa-cogs fa-fw"></i>--}}
{{--                        <p>--}}
{{--                            {{ __('view.setting') }}--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}


{{--                    <ul class="nav nav-treeview">--}}
{{--                        @can('manage-setting')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ fr_route('admin.settings') }}"--}}
{{--                                    class="nav-link {{ areActiveRoutes(['admin.settings']) }}">--}}
{{--                                    <i class="fas fa-cog fa-fw"></i>--}}
{{--                                    <p>@lang('view.general_setting')</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}


{{--                        @if (app('hook')->get('aside_menu_settings'))--}}
{{--                            @foreach (app('hook')->get('aside_menu_settings') as $componentView)--}}
{{--                                {!! $componentView !!}--}}
{{--                            @endforeach--}}
{{--                        @endif--}}


{{--                        @can('manage-notifications-setting')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ fr_route('admin.settings.notifications') }}"--}}
{{--                                    class="nav-link {{ areActiveRoutes(['admin.settings.notifications']) }}">--}}
{{--                                    <i class="fa fa-bell fa-fw"></i>--}}
{{--                                    <p>@lang('view.notifications_settings')</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}

{{--                        @can('manage-google-setting')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ fr_route('admin.settings.google') }}"--}}
{{--                                    class="nav-link {{ areActiveRoutes(['admin.settings.google']) }}">--}}
{{--                                    <i class="fas fa-cog fa-fw"></i>--}}
{{--                                    <p>@lang('view.google_settings')</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}

{{--                        @can('manage-theme-setting')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ fr_route('default-theme.edit') }}"--}}
{{--                                    class="nav-link {{ active_route('default-theme.edit') }}  {{ areActiveRoutes(['default-theme.edit']) }}">--}}
{{--                                    <i class="fab fa-affiliatetheme fa-fw"></i>--}}
{{--                                    <p>@lang('view.themes')</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ fr_route('theme-setting.edit', ['place' => 'homepage']) }}"--}}
{{--                                    class="nav-link {{ active_route('theme-setting.edit', ['place' => 'homepage']) }}  {{ areActiveRoutes(['theme-setting.edit']) }}">--}}
{{--                                    <i class="fab fa-affiliatetheme fa-fw"></i>--}}
{{--                                    <p>@lang('view.theme_setting')</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}

{{--                </li>--}}




                <!--end::Menu-->
            </ul>
            <!--end::Aside Menu-->
        </nav>
        <!--end::Aside menu-->
    </div>
</aside>
<!--end::Aside-->
