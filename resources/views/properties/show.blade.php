@extends('layouts.app')

@section('title', $ad->title)

@push('styles')
    {{-- Leaflet CSS for the map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        /* Ensures the map container has a defined height, crucial for Leaflet to initialize correctly */
        #detail-map { height: 100%; min-height: 256px; /* 16rem */ }
    </style>
@endpush

@push('scripts')
    {{-- Alpine.js is needed for the image gallery and dropdowns --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">

<section class="bg-white w-full">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Agent Control Panel: Only shows if the logged-in user owns this ad --}}
        @if(auth()->check() && auth()->id() == $ad->user_id)
            <div class="flex w-full items-center justify-end bg-white py-6" dir="rtl">
                <div class="flex items-center gap-x-2">
                    <a href="#" class="flex items-center gap-x-1.5 rounded-xl bg-gray-100 py-2 pl-3 pr-4 text-sm font-medium text-gray-600 hover:bg-gray-200">
                        <img src="{{ asset('images/pen.svg') }}" alt="Edit">
                        <span>تعديل</span>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-x-2 rounded-xl border border-slate-400 bg-white px-4 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                            <span>تغيير حالة العقار</span>
                            <svg class="h-5 w-5 text-slate-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 011.06 0L10 11.94l3.72-3.72a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.22 9.28a.75.75 0 010-1.06z" clip-rule="evenodd" /></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute left-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-lg">
                            <div class="py-1">
                                {{-- Add form submissions here to update status later --}}
                                <a href="#" class="flex items-center justify-between border-b px-4 py-3 text-sm hover:bg-gray-50"><span>نشط</span></a>
                                <a href="#" class="flex items-center justify-between border-b px-4 py-3 text-sm hover:bg-gray-50"><span>مباع</span></a>
                                <a href="#" class="flex items-center justify-between px-4 py-3 text-sm text-red-600 hover:bg-red-50"><span>حذف</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Image Gallery powered by Alpine.js -->
        <div x-data="{ 
                images: {{ json_encode($ad->images ?? []) }}, 
                currentIndex: 0,
                get currentImage() { return this.images.length > 0 ? '{{ Storage::url('') }}' + this.images[this.currentIndex] : 'https://placehold.co/800x600?text=No+Image' },
                next() { if (this.images.length > 1) this.currentIndex = (this.currentIndex + 1) % this.images.length; },
                prev() { if (this.images.length > 1) this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; },
                select(index) { this.currentIndex = index; }
            }">
            
            <!-- Thumbnail Gallery -->
            @if(!empty($ad->images) && count($ad->images) > 1)
            <div class="flex justify-center flex-wrap gap-3 mb-6">
                <template x-for="(image, index) in images" :key="index">
                    <button @click="select(index)" 
                            :class="{ 'border-blue-600 opacity-100': currentIndex === index, 'border-transparent opacity-70': currentIndex !== index }"
                            class="thumbnail-btn w-32 h-20 rounded-lg overflow-hidden border-2 hover:opacity-100 transition-all">
                        <img :src="'{{ Storage::url('') }}' + image" :alt="'Thumbnail ' + (index + 1)" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
            @endif

            <div class="grid grid-cols-1 {{ $ad->video_path ? 'lg:grid-cols-2' : '' }} gap-6">
                <!-- Main Image Slider -->
                <div class="relative w-full h-96 rounded-xl overflow-hidden">
                    <img x-bind:src="currentImage" alt="{{ $ad->title }}" class="w-full h-full object-cover transition-opacity duration-300">
                    <div x-show="images.length > 1" class="absolute inset-0 flex items-center justify-between px-4">
                        <button @click="next()" class="bg-white/60 hover:bg-white/90 transition-colors rounded-full w-10 h-10 flex items-center justify-center text-gray-800"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg></button>
                        <button @click="prev()" class="bg-white/60 hover:bg-white/90 transition-colors rounded-full w-10 h-10 flex items-center justify-center text-gray-800"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg></button>
                    </div>
                </div>
                <!-- Video Player (only shows if a video exists) -->
                @if($ad->video_path)
                <div class="relative w-full h-96 rounded-xl overflow-hidden group">
                    <video controls class="w-full h-full object-cover bg-black" poster="{{ !empty($ad->images) ? Storage::url($ad->images[0]) : '' }}">
                        <source src="{{ Storage::url($ad->video_path) }}" type="video/mp4">
                        متصفحك لا يدعم عرض الفيديو.
                    </video>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


<div dir="rtl" class="p-4 sm:p-6 md:p-8 w-full">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8 w-full">

        <!-- Main Content Column -->
        <div class="w-full space-y-8">
            <!-- Header Section -->
            <div class="bg-[rgba(242,242,242,0.35)] rounded-3xl p-5 shadow-sm">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                    <div>
                        <h1 class="text-[28px] font-medium text-[rgba(48,62,124,1)]">{{ $ad->title }}</h1>
                        <div class="flex items-center gap-4 text-[rgba(179,179,179,1)] mt-3 text-[13px]">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                {{ $ad->district->city->name }} - {{ $ad->district->name }}
                            </span>
                            <span class="flex items-center gap-1">
                                <img src="{{ asset('images/clock.svg') }}">
                                {{ $ad->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="text-[32px] font-semibold flex text-[rgba(48,62,124,1)] flex-shrink-0">
                        {{ number_format($ad->total_price) }} <img class="self-start" src="{{ asset('images/ryal.svg') }}"> 
                        @if($ad->listing_purpose == 'rent')
                        <span class="text-[32px] font-medium">/</span><span class="text-[18px] font-medium self-end pb-1">شهري</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Property Details -->
            <div class="bg-[rgba(242,242,242,0.35)] rounded-3xl p-8 shadow-sm">
                <h2 class="text-[18px] font-medium mb-3">تفاصيل العقار</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-8 gap-x-4 text-center">
                    @if($ad->street_width)<div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/arrows.svg') }}"><div class="flex flex-col "><p class="font-bold text-[14.8px] flex items-center">{{ $ad->street_width }}م</p><span class="text-[9px]">عرض الشارع</span></div></div>@endif
                    <div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/area.svg') }}"><div class="flex flex-col "><p class="font-bold text-[14.8px] flex items-center">{{ $ad->area_sq_meters }}م<span class="text-[6px]">2</span></p><span class="text-[9px]">المساحة</span></div></div>
                    @if($ad->age_years)<div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/age.svg') }}"><div class="flex flex-col items-center"><p class="font-bold text-[14.8px] flex items-center">{{ $ad->age_years }} سنين</p><span class="text-[9px]">عمر العقار</span></div></div>@endif
                    @if($ad->facade)<div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/direction.svg') }}"><div class="flex flex-col"><p class="font-bold text-[14.8px] flex items-center">{{ $ad->facade }}</p><span class="text-[9px]">الواجهة </span></div></div>@endif
                    <div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/bathroom.svg') }}"><div class="flex flex-col"><p class="font-bold text-[14.8px] flex items-center">{{ $ad->bathrooms }}</p><span class="text-[9px]">دورة مياة </span></div></div>
                    <div class="flex gap-[10px] items-center justify-center"><img src="{{ asset('images/room.svg') }}"><div class="flex flex-col "><p class="font-bold text-[14.8px] flex items-center">{{ $ad->rooms }}</p><span class="text-[9px]">غرفة نوم </span></div></div>
                </div>

                <h2 class="text-[18px] font-medium mb-4 mt-[25px] border-t pt-6">الوصف</h2>
                <p class="text-[rgba(26,26,26,1)] text-[14px] leading-relaxed pb-5 border-b">{{ $ad->description ?? 'لا يوجد وصف متاح.' }}</p>

                @if($ad->features && count(array_filter($ad->features)))
                <h2 class="text-[18px] font-medium mb-6 mt-[25px]">مميزات العقار</h2>
                <div class="flex flex-wrap flex-row-reverse gap-4 w-full justify-center">
                    @foreach($ad->features as $key => $value)
                        @if($value == "1" && isset($features[$key]))
                            @php $feature = $features[$key]; @endphp
                            <div class="flex flex-col items-center justify-center text-center gap-2 bg-white rounded-xl p-3 shadow-sm min-w-[85px] min-h-[55px]">
                                @if($feature->icon_path)
                                    <img src="{{ Storage::url($feature->icon_path) }}" class="h-6 w-6" alt="{{ $feature->name }}">
                                @endif
                                <span class="text-[12px] font-medium text-gray-700">{{ $feature->name }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                @endif

                <h2 class="text-[18px] font-medium mb-6 mt-[25px] border-t pt-6"> تفاصيل إضافية</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12">
                    <div class="space-y-1">
                        @if($ad->age_years !== null)<div class="flex justify-between py-3 border-b"><span class="text-gray-500">عمر العقار</span><span class="font-semibold">{{ $ad->age_years }} سنوات</span></div>@endif
                        <div class="flex justify-between py-3 border-b"><span class="text-gray-500">نوع العرض</span><span class="font-semibold">{{ $ad->listing_purpose == 'rent' ? 'إيجار' : 'بيع' }}</span></div>
                        @if($ad->furniture_status)<div class="flex justify-between py-3 border-b"><span class="text-gray-500">التأثيث</span><span class="font-semibold">{{ $ad->furniture_status }}</span></div>@endif
                        @if($ad->building_status)<div class="flex justify-between py-3 border-b"><span class="text-gray-500">حالة البناء</span><span class="font-semibold">{{ $ad->building_status }}</span></div>@endif
                        @if($ad->plan_number)<div class="flex justify-between py-3"><span class="text-gray-500">رقم المخطط</span><span class="font-semibold">{{ $ad->plan_number }}</span></div>@endif
                    </div>
                    <div class="space-y-1">
                        @if($ad->property_usage)<div class="flex justify-between py-3 border-b"><span class="text-gray-500">استخدام العقار</span><span class="font-semibold">{{ $ad->property_usage }}</span></div>@endif
                        <div class="flex justify-between py-3 border-b"><span class="text-gray-500">نوع العقار</span><span class="font-semibold">{{ $ad->propertyType->name }}</span></div>
                        <div class="flex justify-between py-3 border-b"><span class="text-gray-500">العقار مرهون</span><span class="font-semibold">{{ $ad->is_mortgaged ? 'نعم' : 'لا' }}</span></div>
                        @if($ad->postal_code)<div class="flex justify-between py-3 border-b"><span class="text-gray-500">الرمز البريدي</span><span class="font-semibold">{{ $ad->postal_code }}</span></div>@endif
                        @if($ad->building_number)<div class="flex justify-between py-3"><span class="text-gray-500">رقم المبنى</span><span class="font-semibold">{{ $ad->building_number }}</span></div>@endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="w-full lg:w-[280px] flex-shrink-0 space-y-6">
            <div class="relative bg-[rgba(250,250,250,1)] rounded-2xl p-5 shadow-sm">
                <div class="flex flex-col gap-2 items-center text-center">
                    <div class="flex items-center justify-between w-full">
                        <h2 class="text-[18px] font-medium text-[rgba(26,26,26,1)]">تفاصيل المعلن</h2>
                    </div>
                    <img class="w-[70px] h-[70px] rounded-full object-cover" src="{{ $ad->user?->profile_photo_path ? Storage::url($ad->user->profile_photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($ad->user->name).'&color=7F9CF5&background=EBF4FF' }}" alt="{{ $ad->user->name }}">
                    <h3 class="text-[18px] font-medium text-[rgba(48,62,124,1)]">{{ $ad->user->name }}</h3>
                    @if($ad->user->hasRole('agent'))
                        <span class="inline-block bg-[rgba(223,246,226,1)] text-[rgba(117,177,123,1)] text-[12px] w-auto px-2 h-[23px] font-medium rounded-md">مسوق عقاري</span>
                    @endif
                    <p class="mt-1 text-[14px] text-[rgba(179,179,179,1)] flex items-center justify-center gap-2">
                        <span class="flex items-center gap-1"><img src="{{ asset('images/locationIcon.svg') }}"> {{ $ad->user->agent?->city?->name ?? 'غير محدد' }}</span> 
                        <span class="flex items-center gap-1"><img src="{{ asset('images/buildingIcon.svg') }}"> +{{ $ad->user->ads->count() }} عقار</span>
                    </p>
                    <div class="flex items-center gap-1">
                        <a href="tel:{{ $ad->user->phone }}" class="h-[27px] px-3 flex items-center gap-2 rounded-lg bg-[rgba(48,63,125,1)] text-white hover:bg-indigo-800 text-xs font-normal"><span>اتصال</span></a>
                        <a href="#" class="h-[27px] px-3 flex items-center gap-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-200/50 text-xs font-normal"><span>راسلني</span></a>
                        <a href="https://wa.me/{{ $ad->user->phone }}" target="_blank" title="WhatsApp" class="flex items-center justify-center w-[34px] h-[27px] rounded-lg bg-[#25D366] text-white hover:bg-[#1EAE54]"><svg width="13.5" height="13.5" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 0.78C3.29 0.78 0.28 3.79 0.28 7.5c0 .93.19 1.81.53 2.61.09.21.15.35.19.46.04.11.04.15.05.16.04.06.03.14-.07.52L0.3 13.63c-.04.16.01.33.12.45.12.12.29.16.45.12l2.37-.63c.38-.1.46-.08.52-.08.01 0 .05.01.16.05.11.04.25.1.46.19.8.34 1.69.53 2.61.53 3.71 0 6.72-3.01 6.72-6.72S10.71.78 7 .78zm-1.9.13l-.06 0c-.3 0-.58 0-.85.12.2.09.37.24.49.4.12.15.23.35.28.56.06.29.01.51-.04.75l-.01.03c.27 1.2.9 2.38 1.88 3.36s2.16 1.61 3.36 1.88l.03.01c.24.05.46.1.75.05.21-.04.41-.16.56-.28.15-.12.3-.29.4-.49.12-.27.12-.55.12-.85v-.06c0-.14-.01-.37-.1-.58-.09-.26-.31-.47-.65-.52l-.01 0c-.43-.07-.75-.12-.98-.15-.12-.02-.21-.03-.29-.04-.06 0-.14-.01-.21 0-.31.02-.55.12-.74.25-.12.08-.25.19-.35.28-.04.03-.08.06-.11.08l-.05.04c-.18.15-.27.22-.39.22-.11 0-.2-.07-.36-.22-.11-.09-.21-.19-.31-.29s-.19-.2-.3-.31c-.15-.17-.22-.24-.22-.36s.07-.27.22-.45l.04-.05c.02-.03.05-.06.09-.1.1-.1.21-.22.29-.34.13-.19.25-.43.27-.74.01-.07 0-.15-.01-.21s-.02-.15-.04-.26c-.03-.23-.09-.55-.15-1 .01-.01 0 0 0 0L8.43 4.67c-.07-.43-.28-.65-.54-.75-.22-.09-.45-.09-.59-.09z" fill="white"/></svg></a>
                    </div>
                </div>
            </div>
            
            <div class="bg-[rgba(250,250,250,1)] w-full lg:w-[280px] rounded-2xl p-4 shadow-sm">
                <h2 class="text-[18px] font-medium text-[rgba(26,26,26,1)] mb-5">العقار على الخريطة</h2>
                <div id="detail-map" class="relative rounded-lg overflow-hidden h-64 z-0"></div>
            </div>
            
            <div class="bg-[rgba(250,250,250,1)] rounded-2xl p-4 w-full lg:w-[280px] shadow-sm">
                <h2 class="text-[18px] font-light text-[rgba(26,26,26,1)] mb-4">معلومات ترخيص الإعلان</h2>
                <div class="space-y-3 text-sm">
                    {{-- License info can be populated here if you add it to the Ad model --}}
                </div>
                <img src="{{ asset('images/QR Code.png') }}" alt="QR Code" class="mt-8 self-center">
            </div>
        </div>
    </div>
</div>
</main>
@endsection

@push('scripts')
    {{-- Leaflet JS for the map --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- DETAIL PAGE MAP INITIALIZATION ---
            const mapElement = document.getElementById('detail-map');
            const lat = {{ $ad->latitude ?? 'null' }};
            const lng = {{ $ad->longitude ?? 'null' }};

            const initMap = () => {
                if (lat && lng) {
                    const map = L.map(mapElement).setView([lat, lng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    L.marker([lat, lng]).addTo(map)
                        .bindPopup("{{ Str::limit($ad->title, 20) }}")
                        .openPopup();
                } else {
                    mapElement.innerHTML = '<div class="flex items-center justify-center h-full bg-gray-200 text-gray-500">الموقع غير محدد على الخريطة</div>';
                }
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        initMap();
                        observer.unobserve(mapElement);
                    }
                });
            });

            if (mapElement) {
                observer.observe(mapElement);
            }
        });
    </script>
@endpush    