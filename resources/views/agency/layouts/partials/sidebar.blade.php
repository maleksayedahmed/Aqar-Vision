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
            <a class="nav-link {{ request()->routeIs('agency.dashboard') ? 'active' : '' }}" href="{{ route('agency.dashboard') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-speedometer"></use></svg> {{ __('attributes.dashboard.title') }}
            </a>
        </li>

        <li class="nav-title">{{ __('attributes.nav.agency_management') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.agents.*') ? 'active' : '' }}" href="{{ route('agency.agents.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-user-follow"></use></svg> {{ __('attributes.agents.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.notifications') ? 'active' : '' }}" href="{{ route('agency.notifications') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-bell"></use></svg> Notifications
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.chat') ? 'active' : '' }}" href="{{ route('agency.chat') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-chat-bubble"></use></svg> {{ __('Chat') }}
            </a>
        </li>
        
        <li class="nav-title">{{ __('attributes.nav.property_management') }}</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.ads.*') ? 'active' : '' }}" href="{{ route('agency.ads.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-newspaper"></use></svg> {{ __('attributes.ads.title') }}
            </a>
        </li>
    </ul>
</div>