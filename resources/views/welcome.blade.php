<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Aqar Vision - Real Estate Management System">
    <meta name="author" content="Aqar Vision">
    <meta name="keyword" content="Real Estate,Property,Management,System">
    <title>{{ config('app.name', 'Aqar Vision') }} - Welcome</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="{{ asset('assets/css/examples.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>
</head>

<body>
    <!-- Header -->
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler" type="button" aria-label="Toggle navigation">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-menu"></use>
                </svg>
            </button>
            <ul class="header-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
                            <svg class="icon icon-lg">
                                <use xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-speedometer">
                                </use>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-coreui-toggle="dropdown"
                            aria-expanded="false">
                            <svg class="icon icon-lg">
                                <use xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-user"></use>
                            </svg>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <svg class="icon me-2">
                                        <use xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-user">
                                        </use>
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <svg class="icon me-2">
                                            <use
                                                xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-account-logout">
                                            </use>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <svg class="icon icon-lg">
                                <use
                                    xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-account-login">
                                </use>
                            </svg>
                            Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <svg class="icon icon-lg">
                                    <use
                                        xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-user-plus">
                                    </use>
                                </svg>
                                Register
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <!-- Hero Section -->
                <div class="row align-items-center py-5">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold text-primary mb-4">
                            Welcome to {{ config('app.name', 'Aqar Vision') }}
                        </h1>
                        <p class="lead text-body-secondary mb-4">
                            Your comprehensive real estate management system. Streamline your property operations,
                            manage agencies, licenses, and more with our powerful platform.
                        </p>
                        <div class="d-flex gap-3">
                            @auth
                                <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary btn-lg">
                                    <svg class="icon me-2">
                                        <use
                                            xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-speedometer">
                                        </use>
                                    </svg>
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <svg class="icon me-2">
                                        <use
                                            xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-account-login">
                                        </use>
                                    </svg>
                                    Get Started
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                        <svg class="icon me-2">
                                            <use
                                                xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-user-plus">
                                            </use>
                                        </svg>
                                        Sign Up
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center">
                            <svg class="img-fluid" width="400" height="300" viewBox="0 0 400 300"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="400" height="300" fill="#f8f9fa" />
                                <path d="M100 100 L300 100 L300 200 L100 200 Z" fill="#321fdb" opacity="0.1" />
                                <path d="M120 120 L280 120 L280 180 L120 180 Z" fill="#321fdb" opacity="0.2" />
                                <circle cx="200" cy="150" r="30" fill="#321fdb" opacity="0.3" />
                                <text x="200" y="155" text-anchor="middle" fill="#321fdb" font-size="16"
                                    font-weight="bold">AQAR</text>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="row py-5">
                    <div class="col-12">
                        <h2 class="text-center mb-5">Key Features</h2>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg class="icon icon-3xl text-primary mb-3">
                                    <use
                                        xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-building">
                                    </use>
                                </svg>
                                <h5 class="card-title">Agency Management</h5>
                                <p class="card-text">Comprehensive tools to manage real estate agencies, their types,
                                    and accreditation status.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg class="icon icon-3xl text-primary mb-3">
                                    <use
                                        xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-id-badge">
                                    </use>
                                </svg>
                                <h5 class="card-title">License Management</h5>
                                <p class="card-text">Track and manage licenses, license types, and agent certifications
                                    efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <svg class="icon icon-3xl text-primary mb-3">
                                    <use
                                        xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-home">
                                    </use>
                                </svg>
                                <h5 class="card-title">Property Management</h5>
                                <p class="card-text">Organize properties by type and purpose with advanced
                                    categorization features.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="row py-5">
                    <div class="col-12 text-center">
                        <div class="card bg-primary text-white">
                            <div class="card-body py-5">
                                <h3 class="card-title">Ready to get started?</h3>
                                <p class="card-text">Join thousands of real estate professionals who trust our
                                    platform.</p>
                                @auth
                                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-light btn-lg">
                                        <svg class="icon me-2">
                                            <use
                                                xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-speedometer">
                                            </use>
                                        </svg>
                                        Access Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                        <svg class="icon me-2">
                                            <use
                                                xlink:href="{{ asset('assets/icons/coreui/free-symbol-defs.svg') }}#cil-user-plus">
                                            </use>
                                        </svg>
                                        Create Account
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-body-secondary mb-0">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Aqar Vision') }}. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('assets/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script>
        // Initialize CoreUI components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new coreui.Dropdown(dropdownToggleEl);
            });

            // Header scroll effect
            const header = document.querySelector('header.header');
            if (header) {
                document.addEventListener('scroll', () => {
                    header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
                });
            }
        });
    </script>
</body>

</html>
