@props(['currentLocale' => null])

@php
    $currentLocale = $currentLocale ?: app()->getLocale();
    $locales = [
        'en' => 'English',
        'ar' => 'العربية'
    ];
@endphp

<div class="relative inline-block">
    <button type="button"
            class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            id="language-menu-button"
            aria-expanded="false"
            aria-haspopup="true">
        <span class="flag-icon flag-icon-{{ $currentLocale === 'ar' ? 'sa' : 'us' }} mr-2"></span>
        {{ $locales[$currentLocale] }}
        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="language-menu-button"
         id="language-menu">
        <div class="py-1" role="none">
            @foreach($locales as $locale => $name)
                <a href="{{ route('language.switch', $locale) }}"
                   class="w-full text-left px-4 py-2 text-sm {{ $currentLocale === $locale ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }} hover:bg-gray-100 hover:text-gray-900 flex items-center"
                   role="menuitem">
                    <span class="flag-icon flag-icon-{{ $locale === 'ar' ? 'sa' : 'us' }} mr-2"></span>
                    {{ $name }}
                    @if($currentLocale === $locale)
                        <svg class="ml-auto h-4 w-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('language-menu-button');
    const menu = document.getElementById('language-menu');

    button.addEventListener('click', function() {
        menu.classList.toggle('hidden');
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
});
</script>

<style>
.flag-icon {
    width: 20px;
    height: 15px;
    background-size: cover;
    border-radius: 2px;
}

.flag-icon-us {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7410 3900"><rect width="7410" height="3900" fill="%23B22234"/><rect width="7410" height="3900" fill="%23FFFFFF"/><rect width="7410" height="3900" fill="%23002837"/><g fill="%23FFFFFF"><g id="s18"><g id="s9"><path id="s" d="m0,450H1e4v0H0v0H0z"/><use href="%23s" y="300"/><use href="%23s" y="600"/><use href="%23s" y="900"/></g><g id="s6"><use href="%23s9" x="1200"/><use href="%23s9" x="2400"/><use href="%23s9" x="3600"/><use href="%23s9" x="4800"/><use href="%23s9" x="6000"/><use href="%23s9" x="7200"/></g></g><g fill="%23B22234"><use href="%23s18" y="30"/><use href="%23s18" y="60"/><use href="%23s18" y="90"/><use href="%23s18" y="120"/><use href="%23s18" y="150"/><use href="%23s18" y="180"/><use href="%23s18" y="210"/></g></svg>');
}

.flag-icon-sa {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 900 600"><rect width="900" height="200" fill="%23006300"/><rect width="900" height="200" y="200" fill="%23FFFFFF"/><rect width="900" height="200" y="400" fill="%23B80000"/><text x="450" y="300" text-anchor="middle" fill="%23006300" font-size="120" font-family="Arial, sans-serif">الله أكبر</text></svg>');
}
</style>
