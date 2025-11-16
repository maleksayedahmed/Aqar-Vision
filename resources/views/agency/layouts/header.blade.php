<header class="header header-sticky mb-4">
    <div class="container-fluid">
    <h4 class="mb-0">{{ __('common.agency_dashboard') }}</h4>
        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="{{ route('agency.profile.edit') }}">
                        {{ __('common.my_profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('common.log_out') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>
