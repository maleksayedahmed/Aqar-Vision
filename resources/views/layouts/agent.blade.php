{{-- resources/views/layouts/agent.blade.php --}}
@auth
    @if (!Auth::user()->agent)
        <?php header('Location: ' . route('user.profile.edit')); exit; ?>
    @endif
@endauth
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-light.png') }}" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-dark.png') }}" media="(prefers-color-scheme: light)">
    {{-- The title will be dynamic for each page --}}
    <title>@yield('title', 'Agent Panel') - Aqarvision</title>

    {{-- CSS Links using the asset() helper --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    {{-- The asset() helper generates the correct URL to your public assets --}}
    <link rel="stylesheet" href="{{ asset('assets/style/main.css') }}">
    @if(app()->getLocale() == 'en' )
    <link href="{{ asset('assets/css/ltr.css') }}" rel="stylesheet">
@endif

    @livewireStyles

    {{-- This allows adding extra styles from child pages if needed --}}
    @stack('styles')

</head>
<body class="bg-white">

    {{-- 1. Include the Header Partial --}}
    @include('partials.agent-header')

    {{-- 2. This is where the unique page content will be injected --}}
        @yield('content')
    

    {{-- 3. Include the Footer Partial --}}
    @include('partials.agent-footer')


    {{-- All your global JavaScript goes here --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- 4. Include the Scripts Partial --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- General Header and Dropdown Logic ---
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            const header = document.getElementById('main-header');
            let lastScrollY = window.scrollY;

            if (header) {
                window.addEventListener('scroll', () => {
                    const currentScrollY = window.scrollY;
                    if (currentScrollY <= 0 || currentScrollY < lastScrollY) {
                        header.classList.remove('-translate-y-full');
                    } else {
                        header.classList.add('-translate-y-full');
                    }
                    lastScrollY = currentScrollY < 0 ? 0 : currentScrollY;
                });
            }

            const userMenuButton = document.getElementById('user-menu-button');
            const userMenu = document.getElementById('user-menu');

            if (userMenuButton && userMenu) {
                userMenuButton.addEventListener('click', (event) => {
                    event.stopPropagation();
                    userMenu.classList.toggle('hidden');
                    userMenuButton.setAttribute('aria-expanded', !userMenu.classList.contains('hidden'));
                });

                window.addEventListener('click', (event) => {
                    if (userMenu && !userMenu.classList.contains('hidden') && !userMenu.contains(event
                            .target) && !userMenuButton.contains(event.target)) {
                        userMenu.classList.add('hidden');
                        userMenuButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Language Dropdown Logic (Authenticated User)
            const languageMenuButton = document.getElementById('language-menu-button');
            const languageMenu = document.getElementById('language-menu');
            const languageDropdownArrow = document.getElementById('language-dropdown-arrow');

            if (languageMenuButton && languageMenu) {
                languageMenuButton.addEventListener('click', (event) => {
                    event.stopPropagation();
                    languageMenu.classList.toggle('hidden');
                    languageMenuButton.setAttribute('aria-expanded', !languageMenu.classList.contains(
                        'hidden'));

                    // Rotate arrow
                    if (languageDropdownArrow) {
                        languageDropdownArrow.classList.toggle('rotate-180');
                    }
                });

                window.addEventListener('click', (event) => {
                    if (languageMenu && !languageMenu.classList.contains('hidden') && !languageMenu
                        .contains(event.target) && !languageMenuButton.contains(event.target)) {
                        languageMenu.classList.add('hidden');
                        languageMenuButton.setAttribute('aria-expanded', 'false');
                        if (languageDropdownArrow) {
                            languageDropdownArrow.classList.remove('rotate-180');
                        }
                    }
                });
            }

            // Language Dropdown Logic (Guest User)
            const languageMenuButtonGuest = document.getElementById('language-menu-button-guest');
            const languageMenuGuest = document.getElementById('language-menu-guest');
            const languageDropdownArrowGuest = document.getElementById('language-dropdown-arrow-guest');

            if (languageMenuButtonGuest && languageMenuGuest) {
                languageMenuButtonGuest.addEventListener('click', (event) => {
                    event.stopPropagation();
                    languageMenuGuest.classList.toggle('hidden');
                    languageMenuButtonGuest.setAttribute('aria-expanded', !languageMenuGuest.classList
                        .contains('hidden'));

                    // Rotate arrow
                    if (languageDropdownArrowGuest) {
                        languageDropdownArrowGuest.classList.toggle('rotate-180');
                    }
                });

                window.addEventListener('click', (event) => {
                    if (languageMenuGuest && !languageMenuGuest.classList.contains('hidden') && !
                        languageMenuGuest.contains(event.target) && !languageMenuButtonGuest.contains(event
                            .target)) {
                        languageMenuGuest.classList.add('hidden');
                        languageMenuButtonGuest.setAttribute('aria-expanded', 'false');
                        if (languageDropdownArrowGuest) {
                            languageDropdownArrowGuest.classList.remove('rotate-180');
                        }
                    }
                });
            }

            // Language Dropdown Logic (Agent User)
            const languageMenuButtonAgent = document.getElementById('language-menu-button-agent');
            const languageMenuAgent = document.getElementById('language-menu-agent');
            const languageDropdownArrowAgent = document.getElementById('language-dropdown-arrow-agent');

            if (languageMenuButtonAgent && languageMenuAgent) {
                languageMenuButtonAgent.addEventListener('click', (event) => {
                    event.stopPropagation();
                    languageMenuAgent.classList.toggle('hidden');
                    languageMenuButtonAgent.setAttribute('aria-expanded', !languageMenuAgent.classList
                        .contains('hidden'));

                    // Rotate arrow
                    if (languageDropdownArrowAgent) {
                        languageDropdownArrowAgent.classList.toggle('rotate-180');
                    }
                });

                window.addEventListener('click', (event) => {
                    if (languageMenuAgent && !languageMenuAgent.classList.contains('hidden') && !
                        languageMenuAgent.contains(event.target) && !languageMenuButtonAgent.contains(event
                            .target)) {
                        languageMenuAgent.classList.add('hidden');
                        languageMenuButtonAgent.setAttribute('aria-expanded', 'false');
                        if (languageDropdownArrowAgent) {
                            languageDropdownArrowAgent.classList.remove('rotate-180');
                        }
                    }
                });
            }
        });
    </script>
    @livewireScripts

    {{-- This allows adding extra scripts from child pages if needed --}}
    @stack('scripts')
</body>
</html>
