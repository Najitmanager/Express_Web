{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['ports.index', 'ports.create','ports.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['ports.index', 'ports.create','ports.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fas fa-anchor-circle-check fa-fw"></i>
        <p>
            {{ __('warehouse::view.ports') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
{{--        @if (auth()->user()->can('view-ports') || $user_role == $admin)--}}
            <li class="nav-item">
                <a href="{{ fr_route('ports.index') }}" class="nav-link {{ areActiveRoutes(['ports.index','ports.edit']) }}">
                    <i class="fas fa-list fa-fw"></i>
                    <p>{{ __('warehouse::view.port_list') }}</p>
                </a>
            </li>
{{--        @endif--}}

        <!-- Create new branch -->
{{--        @if (auth()->user()->can('create-ports') || $user_role == $admin)--}}
            <li class="nav-item">
                <a href="{{ fr_route('ports.create') }}" class="nav-link {{ areActiveRoutes(['ports.create']) }}">
                    <i class="fas fa-plus fa-fw"></i>
                    <p>{{ __('warehouse::view.create_new_port') }}</p>
                </a>
            </li>
{{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}

{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['carriers.index','carriers.create','carriers.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['carriers.index','carriers.create','carriers.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fas fa-ship fa-fw"></i>
        <p>
            {{ __('warehouse::view.carriers') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
        {{--        @if (auth()->user()->can('view-carriers') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('carriers.index') }}" class="nav-link {{ areActiveRoutes(['carriers.index','carrier.edit']) }}">
                <i class="fas fa-list fa-fw"></i>
                <p>{{ __('warehouse::view.carrier_list') }}</p>
            </a>
        </li>
        {{--        @endif--}}

        <!-- Create new branch -->
        {{--        @if (auth()->user()->can('create-carriers') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('carriers.create') }}" class="nav-link {{ areActiveRoutes(['carriers.create']) }}">
                <i class="fas fa-plus fa-fw"></i>
                <p>{{ __('warehouse::view.create_new_carrier') }}</p>
            </a>
        </li>
        {{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}

{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['consignees.index', 'consignees.create','consignees.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['consignees.index', 'consignees.create','consignees.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fas fa-user-tie fa-fw"></i>
        <p>
            {{ __('warehouse::view.consignees') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
        {{--        @if (auth()->user()->can('view-consignees') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('consignees.index') }}" class="nav-link {{ areActiveRoutes(['consignees.index','consignees.edit']) }}">
                <i class="fas fa-list fa-fw"></i>
                <p>{{ __('warehouse::view.consignee_list') }}</p>
            </a>
        </li>
        {{--        @endif--}}

        <!-- Create new branch -->
        {{--        @if (auth()->user()->can('create-consignees') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('consignees.create') }}" class="nav-link {{ areActiveRoutes(['consignees.create']) }}">
                <i class="fas fa-plus fa-fw"></i>
                <p>{{ __('warehouse::view.create_new_consignee') }}</p>
            </a>
        </li>
        {{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}


{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['truck_companies.index', 'truck_companies.create','truck_companies.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['truck_companies.index', 'truck_companies.create','truck_companies.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fas fa-truck-fast fa-fw"></i>
        <p>
            {{ __('warehouse::view.truck_companies') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
        {{--        @if (auth()->user()->can('view-truck_companies') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('truck_companies.index') }}" class="nav-link {{ areActiveRoutes(['truck_companies.index','truck_companies.edit']) }}">
                <i class="fas fa-list fa-fw"></i>
                <p>{{ __('warehouse::view.truck_company_list') }}</p>
            </a>
        </li>
        {{--        @endif--}}

        <!-- Create new branch -->
        {{--        @if (auth()->user()->can('create-truck_companies') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('truck_companies.create') }}" class="nav-link {{ areActiveRoutes(['truck_companies.create']) }}">
                <i class="fas fa-plus fa-fw"></i>
                <p>{{ __('warehouse::view.create_new_truck_company') }}</p>
            </a>
        </li>
        {{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}


{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['customers.index', 'customers.create','customers.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['customers.index', 'customers.create','customers.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fas fa-users fa-fw"></i>
        <p>
            {{ __('warehouse::view.customers') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
        {{--        @if (auth()->user()->can('view-customers') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('customers.index') }}" class="nav-link {{ areActiveRoutes(['customers.index','customers.edit']) }}">
                <i class="fas fa-list fa-fw"></i>
                <p>{{ __('warehouse::view.customer_list') }}</p>
            </a>
        </li>
        {{--        @endif--}}

        <!-- Create new branch -->
        {{--        @if (auth()->user()->can('create-customers') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('customers.create') }}" class="nav-link {{ areActiveRoutes(['customers.create']) }}">
                <i class="fas fa-plus fa-fw"></i>
                <p>{{ __('warehouse::view.create_new_customer') }}</p>
            </a>
        </li>
        {{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}

{{--@can('view-pages')--}}

<li class="nav-item {{ areActiveRoutes(['customers.index', 'customers.create','customers.edit'], 'menu-is-opening menu-open active') }}">
    <a href="#"
       class="nav-link {{ areActiveRoutes(['vehicles.index', 'vehicles.create','vehicles.edit'], 'menu-is-opening menu-open active') }}">
        <i class="fa-solid fa-car fa-fw"></i>
        <p>
            {{ __('warehouse::view.vehicles') }}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <!-- Branch list -->
        {{--        @if (auth()->user()->can('view-vehicles') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('vehicles.index') }}" class="nav-link {{ areActiveRoutes(['vehicles.index','vehicles.edit']) }}">
                <i class="fas fa-list fa-fw"></i>
                <p>{{ __('warehouse::view.vehicle_list') }}</p>
            </a>
        </li>
        {{--        @endif--}}

        <!-- Create new branch -->
        {{--        @if (auth()->user()->can('create-vehicles') || $user_role == $admin)--}}
        <li class="nav-item">
            <a href="{{ fr_route('vehicles.create') }}" class="nav-link {{ areActiveRoutes(['truck_companies.create']) }}">
                <i class="fas fa-plus fa-fw"></i>
                <p>{{ __('warehouse::view.create_new_vehicle') }}</p>
            </a>
        </li>
        {{--        @endif--}}

    </ul>
</li>
{{--@endcan--}}
