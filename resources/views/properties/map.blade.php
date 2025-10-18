@extends('layouts.app')

@section('title', __('common.search_on_map'))

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #search-map {
            height: 65vh;
        }

        /* This CSS removes the default gray square background from Leaflet's custom icons */
        .custom-leaflet-icon {
            background: transparent;
            border: none;
        }
    </style>
@endpush

@section('content')
    <main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">
        <section class="w-full bg-white">
            <div class="space-y-4 px-6">
                <form action="{{ route('properties.map') }}" method="GET" id="filter-form">
                    <!-- Hidden inputs that will hold the actual filter values for form submission -->
                    <input type="hidden" name="listing_purpose" value="{{ request('listing_purpose') }}">
                    <input type="hidden" name="city_id" value="{{ request('city_id') }}">
                    <input type="hidden" name="district_id" value="{{ request('district_id') }}">
                    <input type="hidden" name="price_range" value="{{ request('price_range') }}">
                    <input type="hidden" name="rooms" value="{{ request('rooms') }}">
                    <input type="hidden" name="bathrooms" value="{{ request('bathrooms') }}">
                    <input type="hidden" name="area_range" value="{{ request('area_range') }}">

                    <!-- Top row: Filters and View Toggle -->
                    <div class="flex flex-col-reverse items-center justify-between gap-4">

                        <!-- Filters Container (Using fully-styled custom dropdowns) -->
                        <div class="flex flex-wrap items-center w-full gap-3 justify-between">

                            <!-- Dropdown: Offer Type -->
                            <div class="relative custom-select-wrapper" data-filter-name="listing_purpose">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[50px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                    <span
                                        class="truncate">{{ request('listing_purpose') == 'sale' ? __('common.sale') : (request('listing_purpose') == 'rent' ? __('common.rent') : __('common.offer_type')) }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <ul class="py-1">
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="rent">{{ __('common.rent') }}</a></li>
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="sale">{{ __('common.sale') }}</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Dropdown: City -->
                            <div class="relative custom-select-wrapper" data-filter-name="city_id">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[110px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                    <span
                                        class="truncate">{{ \App\Models\City::find(request('city_id'))->name ?? __('common.city') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <ul class="py-1">
                                        @foreach ($cities as $city)
                                            <li><a href="#"
                                                    class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                    data-value="{{ $city->id }}">{{ $city->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- Dropdown: District -->
                            <div class="relative custom-select-wrapper" data-filter-name="district_id">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                    {{ !request('city_id') ? 'disabled' : '' }}>
                                    <span
                                        class="truncate">{{ \App\Models\District::find(request('district_id'))->name ?? __('common.district') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <ul class="py-1" id="district-options">
                                        <li><a href="#"
                                                class="block px-4 py-2 text-sm text-gray-400">{{ __('common.select_city_first') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Dropdown: Price -->
                            <div class="relative custom-select-wrapper" data-filter-name="price_range">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                    <span
                                        class="truncate">{{ request('price_range') ? str_replace(['-500000', '500000', '0-100000'], [' - 500,000', __('common.price_more_than_500k'), __('common.price_less_than_100k')], request('price_range')) : __('common.price') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <ul class="py-1">
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="0-100000">{{ __('common.price_less_than_100k') }}</a></li>
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="100000-500000">{{ __('common.price_between_100k_500k') }}</a>
                                        </li>
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="500000">{{ __('common.price_more_than_500k') }}</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Dropdown: Rooms & Bathrooms -->
                            <div class="relative custom-select-wrapper">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[60px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                    <span class="truncate">{{ __('common.rooms_bathrooms') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-56 bg-white rounded-md shadow-lg p-2 ring-1 ring-black ring-opacity-5">
                                    <label class="block text-sm font-medium text-gray-700 px-2 py-1">عدد الغرف</label>
                                    <div class="flex justify-around py-2">
                                        <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="1">1</a>
                                        <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="2">2</a>
                                        <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="3">3</a>
                                        <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="4">4</a>
                                        <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="5+">5+</a>
                                    </div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 px-2 py-1 mt-2">{{ __('common.number_of_bathrooms') }}</label>
                                    <div class="flex justify-around py-2">
                                        <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="1">1</a>
                                        <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="2">2</a>
                                        <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="3">3</a>
                                        <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="4">4</a>
                                        <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100"
                                            data-value="5+">5+</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown: Area -->
                            <div class="relative custom-select-wrapper" data-filter-name="area_range">
                                <button type="button"
                                    class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                    <span class="truncate">{{ __('common.area') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                    <ul class="py-1">
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="0-100">{{ __('common.area_less_than_100') }}</a></li>
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="100-250">{{ __('common.area_100_250') }}</a></li>
                                        <li><a href="#"
                                                class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white"
                                                data-value="250">{{ __('common.area_more_than_250') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- View Toggle -->
                        <div id="view-toggle" class="inline-flex p-1 bg-gray-200 rounded-full self-end">
                            <a href="{{ route('properties.search', request()->query()) }}"
                                class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full text-gray-600 hover:bg-gray-100">
                                <img src="{{ asset('images/list-dark.svg') }}"><span>{{ __('common.list_view') }}</span>
                            </a>
                            <span
                                class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full bg-[rgba(48,63,125,1)] text-white">
                                <img src="{{ asset('images/map-light.svg') }}"><span>{{ __('common.map_view') }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end mt-2">
                        <a href="{{ route('properties.map') }}"
                            class="text-sm text-indigo-600 underline">{{ __('common.clear_filters') }}</a>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-200 mt-6 pt-6 px-3">
                <div id="search-map" class="w-full rounded-lg z-0"></div>

                <div class="flex items-end justify-between mt-8">
                    <div>
                        <p class="text-sm text-gray-500 mb-1 px-3">{{ __('common.search_results_on_map') }}</p>
                        <div class="flex items-center gap-3">
                            <h2 class="text-3xl font-normal text-[rgba(48,62,124,1)]">العقارات المتاحة</h2>
                            <span
                                class="text-xs font-medium bg-gray-200 text-[rgba(48,62,124,1)] px-1.5 py-0.5 border-[0.5px] border-[rgba(48,62,124,1)] bg-[rgba(48,62,124,0.06)] rounded-md">{{ $ads->total() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-4 gap-6 mt-8 place-items-center">
                @forelse ($ads as $ad)
                    <div
                        class="bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div>
                            <!-- Image Section -->
                            <div class="relative">
                                <a href="{{ route('properties.show', $ad->id) }}">
                                    <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}"
                                        class="w-full h-48 object-cover rounded-t-lg" alt="{{ $ad->title }}">
                                </a>
                                <div
                                    class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">
                                    {{ $ad->listing_purpose == 'rent' ? 'إيجار' : 'بيع' }}</div>
                                @if (auth()->user())
                                    <button
                                        class="favorite-btn absolute top-2.5 right-3 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow"
                                        data-ad-id="{{ $ad->id }}"
                                        data-favorited="{{ in_array($ad->id, $favoriteAdIds) ? 'true' : 'false' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 {{ in_array($ad->id, $favoriteAdIds) ? 'text-red-500' : 'text-[rgba(242,242,242,1)]' }}"
                                            fill="{{ in_array($ad->id, $favoriteAdIds) ? 'currentColor' : 'none' }}"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                            <!-- Details Section -->
                            <div class="p-3 space-y-[23px]">
                                <div class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                                    <span class="flex items-center gap-0.5 font-semibold text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $ad->district?->city?->name }} -
                                        {{ $ad->district?->name ?? __('common.unspecified_district') }}
                                    </span>
                                    <span class="flex items-center gap-0.5"><img src="{{ asset('images/clock.svg') }}">
                                        {{ $ad->created_at?->format('d/m/Y') }}</span>
                                </div>
                                <div class="space-y-1.5">
                                    <h3 class="text-lg font-bold text-slate-800 leading-tight">
                                        {{ Str::limit($ad->title, 25) }}</h3>
                                    <p class="text-xs text-slate-500">{{ Str::limit($ad->description, 100) }}</p>
                                </div>
                                <div class="flex gap-2 text-sm">
                                    <span
                                        class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img
                                            src="{{ asset('images/building.svg') }}" class="h-4 w-4">
                                        {{ $ad->propertyType?->name ?? 'N/A' }}</span>
                                    <span
                                        class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img
                                            src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> {{ $ad->bathrooms }}
                                        {{ __('common.bathroom_word') }}</span>
                                    <span
                                        class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img
                                            src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> {{ $ad->rooms }}
                                        {{ __('common.rooms_word') }}</span>
                                </div>
                                <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                                    <p class="text-lg font-bold text-indigo-700">{{ number_format($ad->total_price) }}
                                        <span class="text-xs font-medium text-slate-500">{{ __('common.sar') }}</span></p>
                                    <a href="{{ route('properties.show', $ad->id) }}"
                                        class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800">{{ __('common.view_details') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-500 py-16">{{ __('common.no_results_on_map') }}</p>
                @endforelse
            </div>

            <div class="flex justify-center items-center py-[60px]">
                {{ $ads->links() }}
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const filterForm = document.getElementById('filter-form');

            document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
                const button = wrapper.querySelector('.custom-select-button');
                const menu = wrapper.querySelector('.dropdown-menu');
                if (!button || !menu) return;
                const filterName = wrapper.dataset.filterName;
                const hiddenInput = filterForm.querySelector(`input[name="${filterName}"]`);
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) m.classList.add('hidden');
                    });
                    menu.classList.toggle('hidden');
                });
                menu.addEventListener('click', event => {
                    if (event.target.classList.contains('select-option')) {
                        event.preventDefault();
                        const filterName = wrapper.dataset.filterName;
                        const hiddenInput = filterForm.querySelector(`input[name="${filterName}"]`);
                        if (hiddenInput) {
                            hiddenInput.value = event.target.dataset.value;
                        }
                        filterForm.submit();
                    }
                });

                const districtOptionsList = document.getElementById('district-options');
                const districtHiddenInput = filterForm.querySelector('input[name="district_id"]');


                if (districtOptionsList) {
                    districtOptionsList.addEventListener('click', function(event) {
                        if (event.target.classList.contains('select-option')) {
                            event.preventDefault(); // Stop the link from navigating
                            districtHiddenInput.value = event.target.dataset
                            .value; // Get the district ID
                            filterForm.submit(); // Submit the form
                        }
                    });
                }
            });

            const roomsBathroomsWrapper = Array.from(document.querySelectorAll('.custom-select-wrapper')).find(el =>
                !el.dataset.filterName);
            if (roomsBathroomsWrapper) {
                const roomsHiddenInput = filterForm.querySelector('input[name="rooms"]');
                const bathroomsHiddenInput = filterForm.querySelector('input[name="bathrooms"]');
                roomsBathroomsWrapper.querySelectorAll('.room-option').forEach(option => {
                    option.addEventListener('click', e => {
                        e.preventDefault();
                        if (roomsHiddenInput) roomsHiddenInput.value = option.dataset.value;
                        filterForm.submit();
                    });
                });
                roomsBathroomsWrapper.querySelectorAll('.bathroom-option').forEach(option => {
                    option.addEventListener('click', e => {
                        e.preventDefault();
                        if (bathroomsHiddenInput) bathroomsHiddenInput.value = option.dataset.value;
                        filterForm.submit();
                    });
                });
            }

            window.addEventListener('click', () => {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.add('hidden'));
            });

            const districtWrapper = document.querySelector('[data-filter-name="district_id"]');
            const cityIdInput = filterForm.querySelector('input[name="city_id"]');
            if (districtWrapper && cityIdInput) {
                const districtOptionsList = districtWrapper.querySelector('#district-options');
                const districtButton = districtWrapper.querySelector('.custom-select-button');

                function fetchDistricts(cityId) {
                    if (!cityId) {
                        districtOptionsList.innerHTML =
                            '<li><a class="block px-4 py-2 text-sm text-gray-400">اختر مدينة أولاً</a></li>';
                        districtButton.disabled = true;
                        return;
                    }
                    fetch(`/get-districts/${cityId}`)
                        .then(response => response.json())
                        .then(districts => {
                            districtOptionsList.innerHTML = '';
                            if (districts.length > 0) {
                                districts.forEach(district => {
                                    const li = document.createElement('li');
                                    const a = document.createElement('a');
                                    a.href = '#';
                                    a.className =
                                        'select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white';
                                    a.dataset.value = district.id;
                                    a.textContent = district.name;
                                    li.appendChild(a);
                                    districtOptionsList.appendChild(li);
                                });
                                districtButton.disabled = false;
                            } else {
                                districtOptionsList.innerHTML =
                                    '<li><a class="block px-4 py-2 text-sm text-gray-400">لا توجد أحياء</a></li>';
                            }
                        });
                }
                if (cityIdInput.value) fetchDistricts(cityIdInput.value);
            }

            // --- SCRIPT FOR THE SEARCH MAP ---
            const mapElement = document.getElementById('search-map');
            const adsData = @json($allAdsForMap);

            if (mapElement && adsData && adsData.length > 0) {
                const mapCenter = [adsData[0].latitude, adsData[0].longitude] ?? [24.7136, 46.6753];
                const map = L.map(mapElement).setView(mapCenter, 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                adsData.forEach(ad => {
                    if (ad.latitude && ad.longitude) {

                        let thumbnailUrl = 'https://placehold.co/48x48/3B4A7A/ffffff?text=AD';
                        if (ad.images && ad.images.length > 0) {
                            thumbnailUrl = `/storage/${ad.images[0]}`;
                        }

                        const iconHtml = `
                        <div style="background-image: url(${thumbnailUrl});" class="w-10 h-10 bg-cover bg-center rounded-full border-2 border-cyan-400 shadow-lg p-1 bg-white">
                        </div>
                    `;

                        const customIcon = L.divIcon({
                            html: iconHtml,
                            className: 'custom-leaflet-icon',
                            iconSize: [40, 40],
                            iconAnchor: [20, 40],
                            popupAnchor: [0, -40]
                        });

                        const marker = L.marker([ad.latitude, ad.longitude], {
                            icon: customIcon
                        }).addTo(map);

                        const popupContent = `
                        <div class="text-right font-sans p-1" style="min-width: 150px;">
                            <h3 class="font-bold text-md mb-1">${ad.title}</h3>
                            <p class="text-sm text-gray-600">${Number(ad.total_price).toLocaleString()} ر.س</p>
                            <a href="/properties/${ad.id}" class="text-blue-500 hover:underline font-semibold text-xs" target="_blank">رؤية التفاصيل</a>
                        </div>
                    `;
                        marker.bindPopup(popupContent);
                    }
                });
            } else if (mapElement) {
                mapElement.innerHTML =
                    '<div class="flex items-center justify-center h-full bg-gray-100 text-gray-500 rounded-lg">لا توجد نتائج لعرضها على الخريطة</div>';
            }
        });

        document.querySelectorAll('.favorite-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    @auth
                    const adId = this.dataset.adId;
                    const isFavorited = this.dataset.favorited === 'true';

                    // Optimistic UI update
                    updateFavoriteButton(this, !isFavorited);

                    fetch('/favorites/toggle', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                ad_id: adId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                this.dataset.favorited = data.is_favorited;
                                updateFavoriteButton(this, data.is_favorited);

                                // Show success message
                                showNotification(data.message, 'success');
                            } else {
                                // Revert optimistic update on error
                                updateFavoriteButton(this, isFavorited);
                                this.dataset.favorited = isFavorited;
                                showNotification(data.message || 'حدث خطأ', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Revert optimistic update on error
                            updateFavoriteButton(this, isFavorited);
                            this.dataset.favorited = isFavorited;
                            showNotification('حدث خطأ في الشبكة', 'error');
                        });
                @else
                    // Redirect to login if not authenticated
                    window.location.href = '/login';
                @endauth
            });
        });

        function updateFavoriteButton(button, isFavorited) {
            const svg = button.querySelector('svg');
            if (isFavorited) {
                svg.setAttribute('fill', 'currentColor');
                svg.classList.remove('text-[rgba(242,242,242,1)]');
                svg.classList.add('text-red-500');
            } else {
                svg.setAttribute('fill', 'none');
                svg.classList.remove('text-red-500');
                svg.classList.add('text-[rgba(242,242,242,1)]');
            }
        }

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium transform translate-x-full transition-transform duration-300 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;

            // Add to DOM
            document.body.appendChild(notification);

            // Slide in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Slide out and remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    </script>
@endpush
