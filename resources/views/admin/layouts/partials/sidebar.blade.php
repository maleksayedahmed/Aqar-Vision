<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Soft UI Dashboard 3</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.messages.dashboard') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.users.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.agency-types.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.agency-types.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.agency_types.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.agencies.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.agencies.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.agencies.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.license-types.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.license-types.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.license_types.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.licenses.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.licenses.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.licenses.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.property-purposes.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.property-purposes.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.property_purposes.title') }}</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.property-types.*') ? 'active bg-gradient-info' : '' }}"
                    href="{{ route('admin.property-types.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-building"></i>
                    </div>
                    <span class="nav-link-text ms-1">{{ __('attributes.property_types.title') }}</span>
                </a>
            </li>
        </ul>
    </div>

</aside>
