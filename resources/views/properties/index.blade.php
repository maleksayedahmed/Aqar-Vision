@extends('layouts.app')

@section('title', 'نتائج البحث عن عقارات')

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">
<section class="w-full bg-white">
    <div class="space-y-4 px-6">
        <form action="{{ route('properties.search') }}" method="GET" id="filter-form">
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
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[50px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <span class="truncate">{{ request('listing_purpose') == 'sale' ? 'للبيع' : (request('listing_purpose') == 'rent' ? 'للإيجار' : 'نوع العرض') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul class="py-1">
                                <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="rent">للإيجار</a></li>
                                <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="sale">للبيع</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown: City -->
                    <div class="relative custom-select-wrapper" data-filter-name="city_id">
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[110px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <span class="truncate">{{ \App\Models\City::find(request('city_id'))->name ?? 'المدينة' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul class="py-1">
                                @foreach($cities as $city)
                                <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="{{ $city->id }}">{{ $city->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown: District -->
                    <div class="relative custom-select-wrapper" data-filter-name="district_id">
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400" {{ !request('city_id') ? 'disabled' : '' }}>
                            <span class="truncate">{{ \App\Models\District::find(request('district_id'))->name ?? 'الحي' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul class="py-1" id="district-options">
                               <li><a href="#" class="block px-4 py-2 text-sm text-gray-400">اختر مدينة أولاً</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown: Price -->
                    <div class="relative custom-select-wrapper" data-filter-name="price_range">
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <span class="truncate">{{ request('price_range') ? str_replace(['-500000', '500000', '0-100000'], [' - 500,000', 'أكثر من 500,000', 'أقل من 100,000'], request('price_range')) : 'السعر' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul class="py-1">
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="0-100000">أقل من 100,000</a></li>
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="100000-500000">100,000 - 500,000</a></li>
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="500000">أكثر من 500,000</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown: Rooms & Bathrooms -->
                    <div class="relative custom-select-wrapper">
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[60px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <span class="truncate">الغرف ودورات المياه</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-56 bg-white rounded-md shadow-lg p-2 ring-1 ring-black ring-opacity-5">
                            <label class="block text-sm font-medium text-gray-700 px-2 py-1">عدد الغرف</label>
                            <div class="flex justify-around py-2">
                                <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="1">1</a>
                                <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="2">2</a>
                                <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="3">3</a>
                                <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="4">4</a>
                                <a href="#" class="room-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="5+">5+</a>
                            </div>
                             <label class="block text-sm font-medium text-gray-700 px-2 py-1 mt-2">عدد دورات المياه</label>
                            <div class="flex justify-around py-2">
                                <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="1">1</a>
                                <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="2">2</a>
                                <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="3">3</a>
                                <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="4">4</a>
                                <a href="#" class="bathroom-option px-3 py-1 rounded-md hover:bg-gray-100" data-value="5+">5+</a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown: Area -->
                    <div class="relative custom-select-wrapper" data-filter-name="area_range">
                        <button type="button" class="custom-select-button flex w-full justify-between items-center gap-[120px] px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm text-[rgba(52,72,152,1)] font-normal hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <span class="truncate">المساحة</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                        <div class="dropdown-menu hidden absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <ul class="py-1">
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="0-100">أقل من 100 م²</a></li>
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="100-250">100 - 250 م²</a></li>
                               <li><a href="#" class="select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white" data-value="250">أكثر من 250 م²</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- View Toggle -->
                <div id="view-toggle" class="inline-flex p-1 bg-gray-200 rounded-full self-end">
                    <span class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full bg-[rgba(48,63,125,1)] text-white">
                        <img src="{{ asset('images/list.svg') }}"><span>قائمة</span>
                    </span>
                    <a href="{{ route('properties.map', request()->query()) }}" class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full text-gray-600">
                        <img src="{{ asset('images/map.svg') }}"><span>خريطة</span>
                    </a>
                </div>
            </div>

            <div class="flex justify-end mt-2">
                <a href="{{ route('properties.search') }}" class="text-sm text-indigo-600 underline">مسح عوامل التصفية</a>
            </div>
        </form>
    </div>

    <div class="border-t border-gray-200 mt-6 pt-6 px-3">
        <div class="flex items-end justify-between">
            <div>
                 <p class="text-sm text-gray-500 mb-1 px-3">نتائج البحث:</p>
                 <div class="flex items-center gap-3">
                    <h2 class="text-3xl font-normal text-[rgba(48,62,124,1)]">العقارات المتاحة</h2>
                    <span class="text-xs font-medium bg-gray-200 text-[rgba(48,62,124,1)] px-1.5 py-0.5 border-[0.5px] border-[rgba(48,62,124,1)] bg-[rgba(48,62,124,0.06)] rounded-md">{{ $ads->total() }}</span>
                 </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-4 gap-6 mt-8 place-items-center">
        @forelse ($ads as $ad)
            <div class="bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div>
                    <div class="relative">
                        <img src="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : 'https://placehold.co/400x300' }}" class="w-full h-48 object-cover rounded-lg" alt="{{ $ad->title }}">
                        <div class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">{{ $ad->listing_purpose == 'rent' ? 'إيجار' : 'بيع' }}</div>
                        @if (auth()->user())
                                    <button class="favorite-btn absolute top-2.5 right-3 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow"
                                            data-ad-id="{{ $ad->id }}"
                                            data-favorited="{{ in_array($ad->id, $favoriteAdIds) ? 'true' : 'false' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ in_array($ad->id, $favoriteAdIds) ? 'text-red-500' : 'text-[rgba(242,242,242,1)]' }}"
                                            fill="{{ in_array($ad->id, $favoriteAdIds) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                    @endif
                    </div>
                    <div class="p-3 space-y-[23px]">
                        <div class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                            <span class="flex items-center gap-0.5 font-semibold text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                {{ $ad->district?->city?->name }} - {{ $ad->district?->name ?? 'حي غير محدد' }}
                            </span>
                            <span class="flex items-center gap-0.5"><img src="{{ asset('images/clock.svg') }}"> {{ $ad->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="space-y-1.5">
                            <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ Str::limit($ad->title, 25) }}</h3>
                            <p class="text-xs text-slate-500">{{ Str::limit($ad->description, 100) }}</p>
                        </div>
                        <div class="flex gap-2 text-sm">
                            <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> {{ $ad->propertyType?->name ?? 'N/A' }}</span>
                            <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bath.svg') }}" class="h-4 w-4"> {{ $ad->bathrooms }} حمام</span>
                            <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/bed.svg') }}" class="h-4 w-4"> {{ $ad->rooms }} غرف</span>
                        </div>
                        <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                            <p class="text-lg font-bold text-indigo-700">{{ number_format($ad->total_price) }} <span class="text-xs font-medium text-slate-500">ر.س</span></p>
                            <a href="{{ route('properties.show', $ad->id) }}" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800">رؤية التفاصيل</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-500 py-16">لا توجد عقارات تطابق بحثك.</p>
        @endforelse
    </div>

    {{-- Custom Pagination --}}
    <div class="flex justify-center items-center py-[60px]">
        @if ($ads->hasPages())
            <nav class="flex items-center gap-3 flex-row-reverse" aria-label="Pagination">
                @if (!$ads->onFirstPage())<a href="{{ $ads->previousPageUrl() }}" class="text-sm text-gray-600 hover:text-gray-900">السابق</a>@endif
                @foreach ($ads->links()->elements as $element)
                    @if (is_string($element))<span class="flex items-center justify-center w-10 h-10 rounded-full text-gray-500">{{ $element }}</span>@endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $ads->currentPage())
                                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-[rgba(48,63,125,1)] text-white text-sm font-medium" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 text-sm font-medium">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($ads->hasMorePages())<a href="{{ $ads->nextPageUrl() }}" class="text-sm text-gray-600 hover:text-gray-900">التالي</a>@endif
            </nav>
        @endif
    </div>
</section>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const filterForm = document.getElementById('filter-form');

    document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
        const button = wrapper.querySelector('.custom-select-button');
        const menu = wrapper.querySelector('.dropdown-menu');
        if (!button || !menu) return;

        const buttonTextSpan = button.querySelector('span');
        const filterName = wrapper.dataset.filterName;
        const hiddenInput = filterForm.querySelector(`input[name="${filterName}"]`);

        button.addEventListener('click', event => {
            event.stopPropagation();
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });
            menu.classList.toggle('hidden');
        });

        menu.querySelectorAll('.select-option').forEach(option => {
            option.addEventListener('click', event => {
                event.preventDefault();
                buttonTextSpan.textContent = option.textContent;
                if (hiddenInput) hiddenInput.value = option.dataset.value;
                menu.classList.add('hidden');

                if (filterName === 'city_id') {
                    const districtHiddenInput = filterForm.querySelector('input[name="district_id"]');
                    if(districtHiddenInput) districtHiddenInput.value = '';
                    filterForm.submit();
                } else {
                    filterForm.submit();
                }
            });
        });
    });

    const roomsBathroomsWrapper = Array.from(document.querySelectorAll('.custom-select-wrapper')).find(el => !el.dataset.filterName);
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
    const initialCityId = "{{ request('city_id') }}";

    if (districtWrapper) {
        const districtOptionsList = districtWrapper.querySelector('#district-options');
        const districtButton = districtWrapper.querySelector('.custom-select-button');
        const districtHiddenInput = filterForm.querySelector('input[name="district_id"]');
        const districtButtonText = districtButton.querySelector('span');

        function fetchDistricts(cityId) {
            if (!cityId) {
                districtOptionsList.innerHTML = '<li><a class="block px-4 py-2 text-sm text-gray-400">اختر مدينة أولاً</a></li>';
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
                            a.className = 'select-option block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white';
                            a.dataset.value = district.id;
                            a.textContent = district.name;

                            a.addEventListener('click', (event) => {
                                event.preventDefault();
                                districtButtonText.textContent = a.textContent;
                                districtHiddenInput.value = a.dataset.value;
                                districtWrapper.querySelector('.dropdown-menu').classList.add('hidden');
                                filterForm.submit();
                            });
                            li.appendChild(a);
                            districtOptionsList.appendChild(li);
                        });
                        districtButton.disabled = false;
                    } else {
                         districtOptionsList.innerHTML = '<li><a class="block px-4 py-2 text-sm text-gray-400">لا توجد أحياء</a></li>';
                    }
                });
        }

        if (initialCityId) {
            fetchDistricts(initialCityId);
        }
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium transform translate-x-full transition-transform duration-300 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
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
