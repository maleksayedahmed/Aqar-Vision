@extends('layouts.app')

@section('title', __('common.create_ad') . ' - ' . __('common.step_1_of_2'))

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')
<main class="bg-[rgba(250,250,250,1)] px-4 lg:px-20 pt-6 pb-11">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
            <strong class="font-bold">{{ __('common.please_fix_errors') }}</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @php
    $routePrefix = Auth::user() && Auth::user()->agent ? 'agent.ads.' : 'user.ads.';
    @endphp

    <form method="POST" action="{{ route($routePrefix . 'store.step1') }}">
        @csrf

        {{-- Top Header Section --}}
        <section>
            <div class="flex w-full flex-col items-stretch gap-y-4 lg:flex-row lg:items-center lg:justify-between py-4" dir="rtl">
                <a href="{{ route('user.ads.create') }}" class="flex items-center gap-x-3">
                    <img src="{{ asset('images/back-arrow.svg') }}" alt="Back">
                    <div class="text-right">
                        <h3 class="text-2xl lg:text-[26px] font-medium text-[rgba(48,62,124,1)]">{{ __('common.create_ad') }}</h3>
                        <p class="text-[14.3px] font-medium"><span class="mr-1 text-red-500">*</span>{{ __('common.fill_data_carefully') }}</p>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-x-[27px]">
                    <span class="font-medium text-[16px] text-[rgba(48,62,124,1)]">{{ __('common.property_data') }}</span>
                    <div class="flex items-center gap-x-2"><img src="{{ asset('images/rode.svg') }}" alt="Step indicator"></div>
                    <span class="font-medium text-[16px] text-[rgba(181,183,191,1)]">{{ __('common.property_documents') }}</span>
                </div>
                <div class="relative w-full lg:w-[264px]" x-data="{ open: false }">
                    <input type="hidden" name="ad_price_id" value="{{ $selectedAdPrice->id }}">
                    <button @click="open = !open" type="button" class="flex items-center justify-between bg-[rgba(0,0,0,0.02)] w-full h-[53px] hover:bg-gray-200 transition-colors px-4 py-2.5 rounded-xl text-lg lg:text-[20px] font-medium text-black">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ $selectedAdPrice->icon_path ? Storage::url($selectedAdPrice->icon_path) : asset('images/star.png') }}" class="w-8 h-8" alt="Ad Type">
                            <span>{{ $selectedAdPrice->name }}</span>
                        </div>
                        <img src="{{ asset('images/Polygon.svg') }}" alt="Dropdown arrow">
                    </button>
                    <div x-show="open" @click.away="open = false" style="display: none;" class="text-[13.6px] absolute right-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-200 z-10 p-2">
                        @foreach($allAdPrices as $priceOption)
                            <a href="{{ route('user.ads.create.step1', $priceOption) }}" class="flex items-center gap-[8px] w-full p-3 text-right hover:bg-gray-100 rounded-lg transition-colors">
                                <img src="{{ $priceOption->icon_path ? Storage::url($priceOption->icon_path) : asset('images/star.png') }}" class="w-8 h-8" alt="Ad Type Icon">
                                <div class="flex flex-col">
                                    <span class="font-bold text-[rgba(13,18,38,1)]">{{ $priceOption->name }}</span>
                                    {{-- You would need to pass remaining ad counts for this to be dynamic --}}
                                    <span class="text-[9.75px] font-medium text-[rgba(151,151,151,1)]">{{ __('common.remaining_ads_this_month', ['count' => 4]) }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Basic Info Section --}}
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/plaza.svg') }}"></div>
                <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.property_basic_info') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="title" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_title') }}<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="{{ __('common.property_title_placeholder') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
    <label for="property_type_id" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_type_label') }}<span class="text-red-500 mr-1">*</span></label>
    <select
        name="property_type_id"
        id="property_type_id"
        required
        class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml,%3csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20fill%3D%27none%27%20viewBox%3D%270%200%2020%2020%27%3e%3cpath%20stroke%3D%27%236b7280%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%20d%3D%27m6%208%204%204%204-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-[length:1.5em_1.5em] bg-[position:left_0.75rem_center] pl-10 pr-3"
    >
    <option value="">{{ __('common.choose_property_type') }}</option>
        @foreach($propertyTypes as $type)
            <option value="{{ $type->id }}" {{ old('property_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
        @endforeach
    </select>
</div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="listing_purpose" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.transaction_type') }}<span class="text-red-500 mr-1">*</span></label>
                    <select
                        name="listing_purpose"
                        id="listing_purpose"
                        required
                        class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml,%3csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20fill%3D%27none%27%20viewBox%3D%270%200%2020%2020%27%3e%3cpath%20stroke%3D%27%236b7280%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%20d%3D%27m6%208%204%204%204-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-[length:1.5em_1.5em] bg-[position:left_0.75rem_center] pl-10 pr-3"
                    >
                        <option value="rent" {{ old('listing_purpose') == 'rent' ? 'selected' : '' }}>{{ __('common.rent') }}</option>
                        <option value="sale" {{ old('listing_purpose') == 'sale' ? 'selected' : '' }}>{{ __('common.sale') }}</option>
                    </select>
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="total_price" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_price') }}<span class="text-red-500 mr-1">*</span></label>
                    <div class="relative w-full h-full">
                        <input type="number" step="any" name="total_price" id="total_price" required placeholder="{{ __('common.enter_property_price') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 pl-20 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[11px] font-bold text-gray-900 pointer-events-none flex items-center gap-1">
                            <img src="{{ asset('images/ryal.svg') }}" alt="Currency Icon">
                            <span id="price-period"></span>
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="area_sq_meters" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.area_m2') }}<span class="text-red-500 mr-1">*</span></label>
                    <input type="number" step="any" name="area_sq_meters" id="area_sq_meters" value="{{ old('area_sq_meters') }}" required placeholder="{{ __('common.enter_area_m2') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="age_years" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_age') }}</label>
                    <input type="number" name="age_years" id="age_years" value="{{ old('age_years') }}" placeholder="{{ __('common.enter_property_age') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block mb-2 text-[11px] font-medium">{{ __('common.detailed_description') }}</label>
                    <textarea name="description" id="description" rows="5" placeholder="{{ __('common.enter_detailed_description') }}" class="w-full resize-none rounded-lg border border-gray-200 bg-white p-3 text-[11px] focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>
            </div>
        </section>

        {{-- Location Section --}}
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/location-05.svg') }}"></div>
                <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.property_location') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="city_id" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.city_label') }}<span class="text-red-500 mr-1">*</span></label>
                    <select
                        name="city_id"
                        id="city-select"
                        required
                        class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml,%3csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20fill%3D%27none%27%20viewBox%3D%270%200%2020%2020%27%3e%3cpath%20stroke%3D%27%236b7280%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%20d%3D%27m6%208%204%204%204-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-[length:1.5em_1.5em] bg-[position:left_0.75rem_center] pl-10 pr-3"
                    >
                        <option value="">{{ __('common.choose_city') }}</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="district_id" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.district_label') }}<span class="text-red-500 mr-1">*</span></label>
                    <select
                        name="district_id"
                        id="district-select"
                        required
                        class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml,%3csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20fill%3D%27none%27%20viewBox%3D%270%200%2020%2020%27%3e%3cpath%20stroke%3D%27%236b7280%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%20d%3D%27m6%208%204%204%204-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-[length:1.5em_1.5em] bg-[position:left_0.75rem_center] pl-10 pr-3 disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ old('city_id') ? '' : 'disabled' }}
                    >
                        <option value="">{{ __('common.select_city_first') }}</option>
                    </select>
                </div>
                 <div class="flex gap-3 items-center h-[52px]">
                    <label for="province" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.province_label') }}<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="province" id="province" value="{{ old('province') }}" required placeholder="{{ __('common.enter_province_name') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="street_name" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.street_name') }}<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="street_name" id="street_name" value="{{ old('street_name') }}" required placeholder="{{ __('common.enter_street_name') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
            </div>
            <div class="mt-8">
                <label class="block mb-4 text-sm lg:text-lg font-medium text-gray-900">{{ __('common.on_map_label') }}</label>
                <p class="text-sm text-gray-500 mb-4">{{ __('common.drag_pin_instruction') }}</p>
                <div id="map" class="relative h-[300px] md:h-[400px] w-full rounded-xl z-0"></div>
            </div>
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', '24.7136') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', '46.6753') }}">
        </section>

        {{-- Features Section (Checkboxes) --}}
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/star-2.svg') }}"></div>
                <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.property_features') }}</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-y-6 gap-x-2">
                @foreach($features as $feature)
                    @php $slug = str_replace(' ', '_', strtolower($feature->getTranslation('name', 'en'))); @endphp
                    <label class="flex items-center gap-x-2 cursor-pointer">
                        <input type="checkbox" name="attributes[{{ $slug }}]" value="1"
                               @if(is_array(old('attributes')) && array_key_exists($slug, old('attributes'))) checked @endif
                               class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300">
                        <span class="text-sm md:text-[18px]">{{ $feature->name }}</span>
                    </label>
                @endforeach
            </div>
        </section>

        {{-- Additional Details Section --}}
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/details-list.svg') }}"></div>
                <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.additional_details') }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">

                {{-- These fields are now rendered dynamically from the attributes table --}}
                @foreach ($attributes as $attribute)
                    @php
                        $slug = str_replace(' ', '_', strtolower($attribute->getTranslation('name', 'en')));
                    @endphp
                    <div class="flex gap-3 items-center h-[52px]">
    <label for="attr-{{ $slug }}" class="w-[80px] shrink-0 text-[11px] font-medium">{{ $attribute->name }}</label>

    @if ($attribute->type === 'dropdown' && !empty($attribute->choices))
        <select
            name="attributes[{{ $slug }}]"
            id="attr-{{ $slug }}"
            class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 appearance-none bg-[url('data:image/svg+xml,%3csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20fill%3D%27none%27%20viewBox%3D%270%200%2020%2020%27%3e%3cpath%20stroke%3D%27%236b7280%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%20d%3D%27m6%208%204%204%204-4%27/%3e%3c/svg%3e')] bg-no-repeat bg-[length:1.5em_1.5em] bg-[position:left_0.75rem_center] pl-10 pr-3"
        >
            <option value="">{{ __('common.select_placeholder') }}</option>
            @foreach ($attribute->choices as $choice)
                <option value="{{ $choice['en'] }}" {{ old('attributes.'.$slug) == $choice['en'] ? 'selected' : '' }}>
                    {{ $choice[app()->getLocale()] ?? $choice['en'] }}
                </option>
            @endforeach
        </select>
    @else
        <input
            type="{{ $attribute->type }}"
            name="attributes[{{ $slug }}]"
            id="attr-{{ $slug }}"
            value="{{ old('attributes.'.$slug) }}"
            placeholder="{{ $attribute->name }}"
            class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500"
        >
    @endif
</div>
                @endforeach
            </div>
        </section>

        {{-- Next Step Button --}}
        <div class="flex justify-center mt-12">
            <button type="submit" class="flex items-center justify-center gap-x-2 bg-[rgba(48,62,124,1)] hover:bg-blue-800 text-white text-[19px] font-medium py-3 px-8 sm:px-16 w-full sm:w-auto rounded-lg transition-colors">
                <span>{{ __('common.next_step') }}</span>
                <img src="{{ asset('images/next-arrow.svg') }}">
            </button>
        </div>
    </form>
</main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
        const defaultLng = parseFloat(document.getElementById('longitude').value) || 46.6753;
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const map = L.map('map').setView([defaultLat, defaultLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors' }).addTo(map);
        const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
        marker.on('dragend', function (e) {
            const newPosition = marker.getLatLng();
            latInput.value = newPosition.lat.toFixed(7);
            lngInput.value = newPosition.lng.toFixed(7);
        });

        const citySelect = document.getElementById('city-select');
        const districtSelect = document.getElementById('district-select');
        const selectedDistrictId = "{{ old('district_id', '') }}";

        function fetchDistricts(cityId, selectedDistrict = null) {
            if (!cityId) {
                districtSelect.innerHTML = '<option value="">{{ __('common.select_city_first') }}</option>';
                districtSelect.disabled = true;
                return;
            }
            fetch(`/get-districts/${cityId}`)
                .then(response => response.json())
                .then(districts => {
                    districtSelect.innerHTML = '<option value="">{{ __('common.choose_district') }}</option>';
                    districts.forEach(district => {
                        const option = new Option(district.name, district.id);
                        if (selectedDistrict == district.id) { option.selected = true; }
                        districtSelect.add(option);
                    });
                    districtSelect.disabled = false;
                });
        }
        citySelect.addEventListener('change', function () { fetchDistricts(this.value); });
        if (citySelect.value) { fetchDistricts(citySelect.value, selectedDistrictId); }

        const listingPurpose = document.getElementById('listing_purpose');
        const pricePeriod = document.getElementById('price-period');

        function updatePricePeriod() {
            console.log('Listing purpose changed to:', listingPurpose.value);
            if (listingPurpose.value === 'rent') {
                pricePeriod.textContent = '{{ __('common.per_month') }}';
            } else {
                pricePeriod.textContent = '';
            }
        }

        // Initial check
        updatePricePeriod();

        // Listen for changes
        listingPurpose.addEventListener('change', updatePricePeriod);
    });
</script>
@endpush
