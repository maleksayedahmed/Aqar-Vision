<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/img/brand/Logo-Transparent.png') }}" class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
            <img src="{{ asset('assets/img/brand/Logo-Transparent.png') }}" class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-speedometer"></use></svg> {{ __('attributes.dashboard.title') }}
            </a>
        </li>

        <li class="nav-title">{{ __('attributes.nav.core_management') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-user"></use></svg> {{ __('attributes.users.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-shield-alt"></use></svg> {{ __('attributes.roles.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.upgrade-requests.*') ? 'active' : '' }}"
                href="{{ route('admin.upgrade-requests.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-user-plus"></use>
                </svg>
                {{ __('attributes.upgrade_requests.title') }}
                @if($notificationCount > 0)
                    <span class="badge badge-sm bg-danger ms-auto">{{ $notificationCount }}</span>
                @endif
            </a>
        </li>

        <li class="nav-title">{{ __('attributes.nav.agency_management') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agencies.*') ? 'active' : '' }}" href="{{ route('admin.agencies.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-handshake"></use></svg> {{ __('attributes.agencies.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agents.*') ? 'active' : '' }}" href="{{ route('admin.agents.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-user-follow"></use></svg> {{ __('attributes.agents.title') }}
            </a>
        </li>
        
        <li class="nav-title">{{ __('attributes.nav.property_management') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}" href="{{ route('admin.properties.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-house"></use></svg> {{ __('attributes.properties.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.ads.*') ? 'active' : '' }}" href="{{ route('admin.ads.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-newspaper"></use></svg> {{ __('attributes.ads.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-types.*') ? 'active' : '' }}" href="{{ route('admin.property-types.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-layers"></use></svg> {{ __('attributes.property_types.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-purposes.*') ? 'active' : '' }}" href="{{ route('admin.property-purposes.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-tags"></use></svg> {{ __('attributes.property_purposes.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-attributes.*') ? 'active' : '' }}" href="{{ route('admin.property-attributes.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-list-rich"></use></svg> {{ __('attributes.property_attributes.title') }}
            </a>
        </li>

        {{-- Locations Dropdown --}}
        <li class="nav-group {{ request()->routeIs('admin.districts.*') || request()->routeIs('admin.cities.*') ? 'show' : '' }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-location-pin"></use></svg> {{ __('attributes.nav.locations') }}
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> {{ __('attributes.cities.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class.nav-link {{ request()->routeIs('admin.districts.*') ? 'active' : '' }}" href="{{ route('admin.districts.index') }}">
                        <span class="nav-icon"><span class="nav-icon-bullet"></span></span> {{ __('attributes.districts.title') }}
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-title">{{ __('attributes.nav.monetization') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}" href="{{ route('admin.plans.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-wallet"></use></svg> {{ __('attributes.plans.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}" href="{{ route('admin.subscriptions.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-calendar-check"></use></svg> {{ __('attributes.subscriptions.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.ad-prices.*') ? 'active' : '' }}" href="{{ route('admin.ad-prices.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-money"></use></svg> {{ __('attributes.ad_prices.title') }}
            </a>
        </li>
    </ul>
</div>