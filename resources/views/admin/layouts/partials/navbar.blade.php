 <style>
     .sidebar-nav::-webkit-scrollbar {
         width: 12px;
     }

     .sidebar-nav::-webkit-scrollbar-track {
         background-color: transparent;
     }

     .sidebar-nav::-webkit-scrollbar-thumb {
         background-color: transparent;
         border-radius: 6px;
         border: 2px solid #e0e0e0;
     }
 </style>
 <header class="header header-sticky p-0 mb-4">
     <div class="container-fluid border-bottom px-4">
         <button class="header-toggler" type="button"
             onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
             style="margin-inline-start: -14px;">
             <svg class="icon icon-lg">
                 <use xlink:href="/assets/icons/free.svg#cil-menu"></use>
             </svg>
         </button>
         <ul class="header-nav d-none d-lg-flex">
             <li class="nav-item"><a class="nav-link"
                     href="{{ route('admin.dashboard') }}">{{ __('common.dashboard') }}</a></li>
             <li class="nav-item"><a class="nav-link"
                     href="{{ route('admin.users.index') }}">{{ __('common.users') }}</a></li>
             <li class="nav-item"><a class="nav-link" href="#">{{ __('common.settings') }}</a></li>
         </ul>
         <ul class="header-nav ms-auto">
             <li class="nav-item"><a class="nav-link" href="#">
                     <svg class="icon icon-lg">
                         <use xlink:href="/assets/icons/free.svg#cil-bell"></use>
                     </svg></a></li>
             <li class="nav-item"><a class="nav-link" href="#">
                     <svg class="icon icon-lg">
                         <use xlink:href="/assets/icons/free.svg#cil-list-rich"></use>
                     </svg></a></li>
             <li class="nav-item"><a class="nav-link" href="#">
                     <svg class="icon icon-lg">
                         <use xlink:href="/assets/icons/free.svg#cil-envelope-open"></use>
                     </svg></a></li>
         </ul>
         <ul class="header-nav">
             <li class="nav-item py-1">
                 <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
             </li>
             <li class="nav-item dropdown">
                 <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
                     aria-expanded="false" data-coreui-toggle="dropdown">
                     <svg class="icon icon-lg me-2">
                         <use xlink:href="/assets/icons/free.svg#cil-language"></use>
                     </svg>
                     {{ strtoupper(app()->getLocale()) }}
                 </button>
                 <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="{{ route('language.switch', 'en') }}">
                             <svg class="icon icon-lg me-3">
                                 <use xlink:href="/assets/icons/free.svg#cil-flag-alt"></use>
                             </svg>{{ __('common.english') }}
                         </a>
                     </li>
                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="{{ route('language.switch', 'ar') }}">
                             <svg class="icon icon-lg me-3">
                                 <use xlink:href="/assets/icons/free.svg#cil-flag-alt"></use>
                             </svg>{{ __('common.arabic') }}
                         </a>
                     </li>
                 </ul>
             </li>
             <li class="nav-item py-1">
                 <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
             </li>
             <li class="nav-item dropdown">
                 <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
                     aria-expanded="false" data-coreui-toggle="dropdown">
                     <svg class="icon icon-lg theme-icon-active">
                         <use xlink:href="/assets/icons/free.svg#cil-contrast"></use>
                     </svg>
                 </button>
                 <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem;">
                     <li>
                         <button class="dropdown-item d-flex align-items-center" type="button"
                             data-coreui-theme-value="light">
                             <svg class="icon icon-lg me-3">
                                 <use xlink:href="/assets/icons/free.svg#cil-sun"></use>
                             </svg>Light
                         </button>
                     </li>
                     <li>
                         <button class="dropdown-item d-flex align-items-center" type="button"
                             data-coreui-theme-value="dark">
                             <svg class="icon icon-lg me-3">
                                 <use xlink:href="/assets/icons/free.svg#cil-moon"></use>
                             </svg>Dark
                         </button>
                     </li>
                     <li>
                         <button class="dropdown-item d-flex align-items-center active" type="button"
                             data-coreui-theme-value="auto">
                             <svg class="icon icon-lg me-3">
                                 <use xlink:href="/assets/icons/free.svg#cil-contrast"></use>
                             </svg>Auto
                         </button>
                     </li>
                 </ul>
             </li>
             <li class="nav-item py-1">
                 <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
             </li>
             <li class="nav-item dropdown">
                 <a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button"
                     aria-haspopup="true" aria-expanded="false">
                     <div class="avatar avatar-md">
                         @if (Auth::user()->profile_photo_path)
                             <img class="avatar-img" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                 alt="{{ Auth::user()->name }}">
                         @else
                             <span class="avatar-text">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                         @endif
                     </div>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end pt-0">
                     <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">
                         {{ __('common.account') }}</div>
                     <a class="dropdown-item" href="#">
                         <svg class="icon me-2">
                             <use xlink:href="/assets/icons/free.svg#cil-user"></use>
                         </svg> {{ __('common.my_profile') }}
                     </a>
                     <a class="dropdown-item" href="#">
                         <svg class="icon me-2">
                             <use xlink:href="/assets/icons/free.svg#cil-settings"></use>
                         </svg> {{ __('common.settings') }}
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="#">
                         <svg class="icon me-2">
                             <use xlink:href="/assets/icons/free.svg#cil-account-logout"></use>
                         </svg> {{ __('common.log_out') }}
                     </a>
                 </div>
             </li>
         </ul>
     </div>
     <div class="container-fluid px-4">
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb my-0">
                 <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('common.home') }}</a>
                 </li>
                 <li class="breadcrumb-item active"><span>@yield('breadcrumb', __('common.dashboard'))</span></li>
             </ol>
         </nav>
     </div>
 </header>
