<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/img/brand/Logo-Transparent.png') }}" class="sidebar-brand-full" width="88"
                height="32" alt="CoreUI Logo">
            <img src="{{ asset('assets/img/brand/Logo-Transparent.png') }}" class="sidebar-brand-narrow" width="32"
                height="32" alt="CoreUI Logo">
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-speedometer"></use>
                </svg> Dashboard
            </a>
        </li>
        <li class="nav-title">Management</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                href="{{ route('admin.users.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-user"></use>
                </svg> {{ __('attributes.users.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                href="{{ route('admin.roles.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-shield-alt"></use>
                </svg> {{ __('attributes.roles.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agency-types.*') ? 'active' : '' }}"
                href="{{ route('admin.agency-types.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-building"></use>
                </svg> {{ __('attributes.agency_types.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agencies.*') ? 'active' : '' }}"
                href="{{ route('admin.agencies.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-handshake"></use>
                </svg> {{ __('attributes.agencies.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agents.*') ? 'active' : '' }}"
                href="{{ route('admin.agents.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-user-follow"></use>
                </svg> {{ __('attributes.agents.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.agent-types.*') ? 'active' : '' }}"
                href="{{ route('admin.agent-types.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-user"></use>
                </svg> {{ __('attributes.agents.agent_type_title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.license-types.*') ? 'active' : '' }}"
                href="{{ route('admin.license-types.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-certificate"></use>
                </svg> {{ __('attributes.license_types.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.licenses.*') ? 'active' : '' }}"
                href="{{ route('admin.licenses.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-id-card"></use>
                </svg> {{ __('attributes.licenses.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-purposes.*') ? 'active' : '' }}"
                href="{{ route('admin.property-purposes.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-home"></use>
                </svg> {{ __('attributes.property_purposes.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-types.*') ? 'active' : '' }}"
                href="{{ route('admin.property-types.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-building"></use>
                </svg> {{ __('attributes.property_types.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.property-attributes.*') ? 'active' : '' }}"
                href="{{ route('admin.property-attributes.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-list-rich"></use>
                </svg> {{ __('attributes.property_attributes.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.commercial-records.*') ? 'active' : '' }}"
                href="{{ route('admin.commercial-records.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="/assets/icons/free.svg#cil-briefcase"></use>
                </svg> {{ __('attributes.commercial_records.title') }}
            </a>
        </li>
    </ul>
</div>
