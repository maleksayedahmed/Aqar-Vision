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
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-speedometer"></use></svg> Dashboard
            </a>
        </li>

        <li class="nav-title">Agency Management</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.agents.*') ? 'active' : '' }}" href="{{ route('agency.agents.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-user-follow"></use></svg> Agents
            </a>
        </li>
        
        <li class="nav-title">Property Management</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.properties.*') ? 'active' : '' }}" href="{{ route('agency.properties.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-house"></use></svg> Properties
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('agency.ads.*') ? 'active' : '' }}" href="{{ route('agency.ads.index') }}">
                <svg class="nav-icon"><use xlink:href="/assets/icons/free.svg#cil-newspaper"></use></svg> Ads Management
            </a>
        </li>
    </ul>
</div>