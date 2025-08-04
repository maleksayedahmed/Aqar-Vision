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

    {{-- For guests, include both the login and signup modals --}}
    @guest
        @include('partials.login-modal')
        @include('partials.signup-modal')
    @endguest
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // --- MODAL SWITCHING LOGIC ---
            const loginModal = document.getElementById('login-modal');
            const signupModal = document.getElementById('signup-modal');

            const openLoginModalBtn = document.getElementById('open-login-modal');
            const closeLoginModalBtn = document.getElementById('close-login-modal');
            const closeSignupModalBtn = document.getElementById('close-signup-modal');

            const switchToSignupBtn = document.getElementById('switch-to-signup-modal');
            const switchToLoginBtn = document.getElementById('switch-to-login-modal');
            const backToLoginBtn = document.getElementById('back-to-login-modal');

            // Functions to toggle modals
            const showLoginModal = () => {
                if (signupModal) signupModal.classList.add('hidden');
                if (loginModal) loginModal.classList.remove('hidden');
            };
            const showSignupModal = () => {
                if (loginModal) loginModal.classList.add('hidden');
                if (signupModal) signupModal.classList.remove('hidden');
            };
            const closeAllModals = () => {
                if (loginModal) loginModal.classList.add('hidden');
                if (signupModal) signupModal.classList.add('hidden');
            };

            // Event Listeners for buttons
            if (openLoginModalBtn) openLoginModalBtn.addEventListener('click', showLoginModal);
            if (closeLoginModalBtn) closeLoginModalBtn.addEventListener('click', closeAllModals);
            if (closeSignupModalBtn) closeSignupModalBtn.addEventListener('click', closeAllModals);

            if (switchToSignupBtn) switchToSignupBtn.addEventListener('click', showSignupModal);
            if (switchToLoginBtn) switchToLoginBtn.addEventListener('click', showLoginModal);
            if (backToLoginBtn) backToLoginBtn.addEventListener('click', showLoginModal);

            // Close modals if the background overlay is clicked
            if (loginModal) loginModal.addEventListener('click', (e) => {
                if (e.target === loginModal) closeAllModals();
            });
            if (signupModal) signupModal.addEventListener('click', (e) => {
                if (e.target === signupModal) closeAllModals();
            });
        });
    </script>

    {{-- This allows adding extra scripts from child pages if needed --}}
    @stack('scripts')
</body>
</html>