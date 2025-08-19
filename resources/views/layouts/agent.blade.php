{{-- resources/views/layouts/agent.blade.php --}}
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    {{-- The asset() helper generates the correct URL to your public assets --}}
    <link rel="stylesheet" href="{{ asset('assets/style/main.css') }}">

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
        // Paste ALL the JavaScript from your original HTML file here.
        // A better long-term solution is to move this to public/assets/js/app.js
        // and link it with <script src="{{ asset('assets/js/app.js') }}"></script>
    </script>

    {{-- This allows adding extra scripts from child pages if needed --}}
    @stack('scripts')
</body>
</html>
