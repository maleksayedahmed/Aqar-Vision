@extends('layouts.agent')

@section('title', 'أضف اعلان جديد - الخطوة 1')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush

@section('content')
<main class="bg-[rgba(250,250,250,1)] px-4 lg:px-20 pt-6 pb-11">

    <form method="POST" action="{{ route('agent.ads.store.step1') }}">
        @csrf

        <section class="">
            <div class="flex w-full flex-col items-stretch gap-y-4 lg:flex-row lg:items-center lg:justify-between py-4" dir="rtl">
                <a href="{{ route('agent.ads.create') }}" class="flex items-center gap-x-3">
                    <img src="{{ asset('images/back-arrow.svg') }}">
                    <div class="text-right">
                        <h3 class="text-2xl lg:text-[26px] font-medium text-[rgba(48,62,124,1)]">أضف اعلان جديد</h3>
                        <p class="text-[14.3px] font-medium"><span class="mr-1 text-red-500">*</span>نرجو تعبئة البيانات بدقة</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-x-[27px]">
                    <span class="font-medium text-[16px] text-[rgba(48,62,124,1)]">بيانات العقار</span>
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('images/rode.svg') }}">
                    </div>
                    <span class="font-medium text-[16px] text-[rgba(181,183,191,1)]">مستندات العقار</span>
                </div>

                <div class="relative w-full lg:w-[264px]" x-data="{ open: false }">
                    <input type="hidden" name="ad_price_id" value="{{ $selectedAdPrice->id }}">
                    <button @click="open = !open" type="button" class="flex items-center justify-between bg-[rgba(0,0,0,0.02)] w-full h-[53px] hover:bg-gray-200 transition-colors px-4 py-2.5 rounded-xl text-lg lg:text-[20px] font-medium text-black">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ asset('images/star.png') }}">
                            <span>{{ $selectedAdPrice->name }}</span>
                        </div>
                        <img src="{{ asset('images/Polygon.svg') }}">
                    </button>
                    <div x-show="open" @click.away="open = false" style="display: none;" class="text-[13.6px] absolute right-0 top-full mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-200 z-10 p-2">
                        @foreach($allAdPrices as $priceOption)
                            <a href="{{ route('agent.ads.create.step1', $priceOption) }}" class="flex items-center gap-[8px] w-full p-3 text-right hover:bg-gray-100 rounded-lg transition-colors">
                                <img src="{{ asset('images/star.png') }}" alt="Ad Type Icon">
                                <div class="flex flex-col">
                                    <span class="font-bold text-[rgba(13,18,38,1)]">{{ $priceOption->name }}</span>
                                    <span class="text-[9.75px] font-medium text-[rgba(151,151,151,1)]">متبقي 4 اعلانات هذا الشهر.</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Basic Info Section -->
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl">
                    <img src="{{ asset('images/plaza.svg') }}">
                </div>
                <h2 class="text-base lg:text-[18px] font-bold">معلومات العقار الأساسية</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="title" class="w-[80px] shrink-0 text-[11px] font-medium">عنوان العقار<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="مثال: شقة ايجار مميزة" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="age" class="w-[80px] shrink-0 text-[11px] font-medium">عمر العقار</label>
                    <input type="text" name="age" id="age" value="{{ old('age') }}" placeholder="ادخل عمر العقار (اختياري)" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="transaction_type" class="w-[80px] shrink-0 text-[11px] font-medium">نوع المعاملة<span class="text-red-500 mr-1">*</span></label>
                    <select name="transaction_type" id="transaction_type" required class="w-full h-[52px] text-[11px] appearance-none rounded-lg border border-gray-200 bg-white px-3 text-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="sell" {{ old('transaction_type') == 'sell' ? 'selected' : '' }}>بيع</option>
                        <option value="rent" {{ old('transaction_type') == 'rent' ? 'selected' : '' }}>إيجار</option>
                    </select>
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="floor_number" class="w-[80px] shrink-0 text-[11px] font-medium">رقم الدور</label>
                    <input type="text" name="floor_number" id="floor_number" value="{{ old('floor_number') }}" placeholder="ادخل رقم الدور" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="price" class="w-[80px] shrink-0 text-[11px] font-medium">سعر العقار</label>
                    <input type="number" step="any" name="price" id="price" value="{{ old('price') }}" required placeholder="اضف سعر عقارك الذي تراه مناسب" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="finishing_status" class="w-[80px] shrink-0 text-[11px] font-medium">حالة التشطيب<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="finishing_status" id="finishing_status" value="{{ old('finishing_status') }}" required placeholder="نصف تشطيب - متشطب بالكامل" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="property_type" class="w-[80px] shrink-0 text-[11px] font-medium">نوع العقار<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="property_type" id="property_type" value="{{ old('property_type') }}" required placeholder="شقة - فيلا - أرض - مكتب" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="direction" class="w-[80px] shrink-0 text-[11px] font-medium">جهة العقار</label>
                    <input type="text" name="direction" id="direction" value="{{ old('direction') }}" placeholder="شمالي - جنوبي - غربي - شرقي" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="bathrooms" class="w-[80px] shrink-0 text-[11px] font-medium">دورات المياة<span class="text-red-500 mr-1">*</span></label>
                    <input type="number" name="bathrooms" id="bathrooms" value="{{ old('bathrooms') }}" required placeholder="ادخل عدد دورات المياة" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="rooms" class="w-[80px] shrink-0 text-[11px] font-medium">عدد الغرف<span class="text-red-500 mr-1">*</span></label>
                    <input type="number" name="rooms" id="rooms" value="{{ old('rooms') }}" required placeholder="اختر عدد الغرف" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="area" class="w-[80px] shrink-0 text-[11px] font-medium">المساحة<span class="text-red-500 mr-1">*</span></label>
                    <input type="number" step="any" name="area" id="area" value="{{ old('area') }}" required placeholder="ادخل المساحة" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block mb-2 text-[11px] font-medium">الوصف التفصيلي</label>
                    <textarea name="description" id="description" rows="5" placeholder="اكتب وصفاً تفصيلياً لعقارك..." class="w-full resize-none rounded-lg border border-gray-200 bg-white p-3 text-[11px] text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">{{ old('description') }}</textarea>
                </div>
            </div>
        </section>

        <!-- Location Section -->
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl">
                    <img src="{{ asset('images/location-05.svg') }}">
                </div>
                <h2 class="text-base lg:text-[18px] font-bold">موقع العقار</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="city" class="w-[80px] shrink-0 text-[11px] font-medium">المدينة<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" required placeholder="اختر المدينة" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="neighborhood" class="w-[80px] shrink-0 text-[11px] font-medium">اسم الحي<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="neighborhood" id="neighborhood" value="{{ old('neighborhood') }}" required placeholder="اسم الحي" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="province" class="w-[80px] shrink-0 text-[11px] font-medium">المحافظة<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="province" id="province" value="{{ old('province') }}" required placeholder="اختر المحافظة" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="street" class="w-[80px] shrink-0 text-[11px] font-medium">اسم الشارع<span class="text-red-500 mr-1">*</span></label>
                    <input type="text" name="street" id="street" value="{{ old('street') }}" required placeholder="اسم الشارع" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3 text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all">
                </div>
            </div>

            <div class="mt-8">
                <label class="block mb-4 text-sm lg:text-lg font-medium text-gray-900">الموقع علي الخريطة</label>
                <p class="text-sm text-gray-500 mb-4">اسحب الدبوس لتحديد الموقع الدقيق للعقار على الخريطة.</p>
                <div id="map" class="relative h-[300px] md:h-[400px] w-full rounded-xl z-0"></div>
            </div>
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', '24.7136') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', '46.6753') }}">
        </section>

        <!-- Features Section -->
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl">
                    <img src="{{ asset('images/star-2.svg') }}">
                </div>
                <h2 class="text-base lg:text-[18px] font-bold">مميزات العقار</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-y-6 gap-x-2">
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="internet" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">إنترنت</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="central_ac" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">تكييف مركزي</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="parking" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">مواقف سيارات</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="pool" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">مسبح</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="elevator" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">مصعد</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="kitchen" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">مطبخ مجهز</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="security" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">أمن</span></label>
                <label class="flex items-center gap-x-2 cursor-pointer"><input type="checkbox" name="features[]" value="garden" class="form-checkbox h-5 w-5 text-blue-600"><span class="text-sm md:text-[18px]">حديقة</span></label>
            </div>
        </section>
        
        <!-- Additional Details Section -->
        <section class="mt-6 bg-white p-4 lg:p-7 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] lg:ml-0 lg:mr-[-28px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl">
                    <img src="{{ asset('images/details-list.svg') }}">
                </div>
                <h2 class="text-base lg:text-[18px] font-bold">تفاصيل اضافية</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 md:gap-x-16 gap-y-6">
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="usage" class="w-[80px] shrink-0 text-[11px] font-medium">استخدام العقار</label>
                    <input type="text" name="usage" id="usage" value="{{ old('usage') }}" placeholder="سكني" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="plan_number" class="w-[80px] shrink-0 text-[11px] font-medium">رقم المخطط</label>
                    <input type="text" name="plan_number" id="plan_number" value="{{ old('plan_number') }}" placeholder="ادخل رقم المخطط" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="mortgaged" class="w-[80px] shrink-0 text-[11px] font-medium">العقار مرهون</label>
                    <select name="mortgaged" id="mortgaged" class="w-full h-[52px] text-[11px] appearance-none rounded-lg border border-gray-200 bg-white px-3">
                        <option value="no" {{ old('mortgaged') == 'no' ? 'selected' : '' }}>لا</option>
                        <option value="yes" {{ old('mortgaged') == 'yes' ? 'selected' : '' }}>نعم</option>
                    </select>
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="furniture" class="w-[80px] shrink-0 text-[11px] font-medium">الأثاث</label>
                    <input type="text" name="furniture" id="furniture" value="{{ old('furniture') }}" placeholder="غير مفروش" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="build_status" class="w-[80px] shrink-0 text-[11px] font-medium">حالة البناء</label>
                    <input type="text" name="build_status" id="build_status" value="{{ old('build_status') }}" placeholder="جاهز - غير جاهز" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="building_number" class="w-[80px] shrink-0 text-[11px] font-medium">رقم المبنى</label>
                    <input type="text" name="building_number" id="building_number" value="{{ old('building_number') }}" placeholder="ادخل رقم المبني" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
                <div class="flex gap-3 items-center h-[52px]">
                    <label for="postal_code" class="w-[80px] shrink-0 text-[11px] font-medium">الرمز البريدي</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" placeholder="ادخل الرمز البريدي" class="w-full h-[52px] text-[11px] rounded-lg border border-gray-200 bg-white px-3">
                </div>
            </div>
        </section>

        <!-- Next Step Button -->
        <div class="flex justify-center mt-12">
            <button type="submit" class="flex items-center justify-center gap-x-2 bg-[rgba(48,62,124,1)] hover:bg-blue-800 text-white text-[19px] font-medium py-3 px-8 sm:px-16 w-full sm:w-auto rounded-lg transition-colors">
                <span>الخطوة التالية</span>
                <img src="{{ asset('images/next-arrow.svg') }}">
            </button>
        </div>
    </form>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
        const defaultLng = parseFloat(document.getElementById('longitude').value) || 46.6753;

        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        marker.on('dragend', function (e) {
            const newPosition = marker.getLatLng();
            latInput.value = newPosition.lat.toFixed(7);
            lngInput.value = newPosition.lng.toFixed(7);
        });
    });
</script>
@endpush