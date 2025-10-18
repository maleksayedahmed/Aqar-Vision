{{-- This input is only really needed for the create form, but doesn't hurt in edit --}}
{{-- It uses the ?? operator to safely get the value from either the create or edit context --}}
<input type="hidden" name="ad_price_id" value="{{ $ad->ad_price_id ?? $selectedAdPrice->id }}">

{{-- Basic Info Section --}}
<section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
    <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
        <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/plaza.svg') }}"></div>
    <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.property_basic_info') }}</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
        <div class="flex gap-3 items-center h-[52px]">
            <label for="title" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_title') }}<span class="text-red-500 mr-1">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $ad->title) }}" required placeholder="{{ __('common.property_title') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="property_type_id" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_type_label') }}<span class="text-red-500 mr-1">*</span></label>
            <select name="property_type_id" id="property_type_id" required class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">{{ __('common.choose_property_type') }}</option>
                @foreach($propertyTypes as $type)
                    <option value="{{ $type->id }}" @selected(old('property_type_id', $ad->property_type_id) == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="listing_purpose" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.transaction_type') }}<span class="text-red-500 mr-1">*</span></label>
            <select name="listing_purpose" id="listing_purpose" required class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="rent" @selected(old('listing_purpose', $ad->listing_purpose) == 'rent')>{{ __('common.rent') }}</option>
                <option value="sale" @selected(old('listing_purpose', $ad->listing_purpose) == 'sale')>{{ __('common.sale') }}</option>
            </select>
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="total_price" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_price') }}<span class="text-red-500 mr-1">*</span></label>
            <input type="number" step="any" name="total_price" id="total_price" value="{{ old('total_price', $ad->total_price) }}" required placeholder="{{ __('common.property_price') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[11px] font-medium text-gray-500">{{ __('common.sar_word') }}</span>
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="area_sq_meters" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.area_m2') }}<span class="text-red-500 mr-1">*</span></label>
            <input type="number" step="any" name="area_sq_meters" id="area_sq_meters" value="{{ old('area_sq_meters', $ad->area_sq_meters) }}" required placeholder="{{ __('common.area_m2') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="age_years" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.property_age') }}</label>
            <input type="number" name="age_years" id="age_years" value="{{ old('age_years', $ad->age_years) }}" placeholder="{{ __('common.property_age') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
        </div>
        <div class="col-span-1 md:col-span-2">
            <label for="description" class="block mb-2 text-[11px] font-medium">{{ __('common.detailed_description') }}</label>
            <textarea name="description" id="description" rows="5" placeholder="{{ __('common.detailed_description') }}" class="w-full resize-none rounded-lg border border-gray-200 bg-white p-3 text-[11px] focus:outline-none focus:ring-1 focus:ring-blue-500">{{ old('description', $ad->description) }}</textarea>
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
            <select name="city_id" id="city-select" required class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                <option value="">{{ __('common.choose_city') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @selected(old('city_id', optional($ad->district)->city_id) == $city->id)>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="district_id" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.district_label') }}<span class="text-red-500 mr-1">*</span></label>
            <select name="district_id" id="district-select" required class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3" {{ old('city_id', optional($ad->district)->city_id) ? '' : 'disabled' }}>
                <option value="">{{ __('common.select_city_first') }}</option>
            </select>
        </div>
         <div class="flex gap-3 items-center h-[52px]">
            <label for="province" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.province_label') }}<span class="text-red-500 mr-1">*</span></label>
            <input type="text" name="province" id="province" value="{{ old('province', $ad->province) }}" required placeholder="{{ __('common.province_label') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
        </div>
        <div class="flex gap-3 items-center h-[52px]">
            <label for="street_name" class="w-[80px] shrink-0 text-[11px] font-medium">{{ __('common.street_name') }}<span class="text-red-500 mr-1">*</span></label>
            <input type="text" name="street_name" id="street_name" value="{{ old('street_name', $ad->street_name) }}" required placeholder="{{ __('common.street_name') }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
        </div>
    </div>
    <div class="mt-8">
    <label class="block mb-4 text-sm lg:text-lg font-medium text-gray-900">{{ __('common.on_map_label') }}</label>
    <p class="text-sm text-gray-500 mb-4">{{ __('common.drag_pin_instruction') }}</p>
        <div id="map" class="relative h-[300px] md:h-[400px] w-full rounded-xl z-0"></div>
    </div>
    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $ad->latitude ?? '24.7136') }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $ad->longitude ?? '46.6753') }}">
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
                <input type="checkbox" name="attributes[{{ $slug }}]" value="1" @checked(old('attributes.'.$slug, data_get($ad->features, $slug))) class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300">
                <span class="text-sm md:text-[18px]">{{ $feature->name }}</span>
            </label>
        @endforeach
    </div>
</section>

{{-- Additional Details Section (Dropdowns, Text, Number) --}}
<section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
    <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
        <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl"><img src="{{ asset('images/details-list.svg') }}"></div>
    <h2 class="text-base lg:text-[18px] font-bold">{{ __('common.additional_details') }}</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
        @foreach ($attributes as $attribute)
            @php $slug = str_replace(' ', '_', strtolower($attribute->getTranslation('name', 'en'))); @endphp
            <div class="flex gap-3 items-center h-[52px]">
                <label for="attr-{{ $slug }}" class="w-[80px] shrink-0 text-[11px] font-medium">{{ $attribute->name }}</label>
                @if ($attribute->type === 'dropdown')
                    <select name="attributes[{{ $slug }}]" id="attr-{{ $slug }}" class="w-full h-full text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                        <option value="">{{ __('common.select_placeholder') }}</option>
                        @foreach ($attribute->choices as $choice)
                            <option value="{{ $choice['en'] }}" @selected(old('attributes.'.$slug, data_get($ad->features, $slug)) == $choice['en'])>
                                {{ $choice[app()->getLocale()] ?? $choice['en'] }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach
    </div>
</section>
