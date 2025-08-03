{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- The title will be dynamic for each page --}}
    <title>@yield('title', 'Aqarvision')</title>

    {{-- CSS Links using the asset() helper for proper URL generation --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/style/main.css') }}">

    {{-- This allows adding extra styles from child pages if needed --}}
    @stack('styles')
</head>
<body class="bg-white">

    {{-- 1. Include the Header Partial --}}
    @include('partials.header')

    {{-- 2. This is where the unique page content will be injected --}}
    <main>
        @yield('content')
    </main>

    {{-- 3. Include the Footer Partial --}}
    @include('partials.footer')

    
    <script>
        // Header scroll functionality
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
                if (currentScrollY <= 0) {
                    header.classList.remove('-translate-y-full');
                } else if (currentScrollY < lastScrollY) {
                    header.classList.remove('-translate-y-full');
                } else {
                    header.classList.add('-translate-y-full');
                }
                lastScrollY = currentScrollY < 0 ? 0 : currentScrollY;
            });
        }

        // --- User Profile Dropdown Logic ---
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        if (userMenuButton && userMenu) {
            userMenuButton.addEventListener('click', (event) => {
                event.stopPropagation();
                userMenu.classList.toggle('hidden');
                userMenuButton.setAttribute('aria-expanded', !userMenu.classList.contains('hidden'));
            });

            window.addEventListener('click', (event) => {
                if (!userMenu.classList.contains('hidden') && !userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    userMenu.classList.add('hidden');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
    </script>

    {{-- This allows adding extra scripts from child pages if needed --}}
    @stack('scripts')
</body>
</html>