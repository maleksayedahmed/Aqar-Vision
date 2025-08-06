@extends('layouts.app')

@section('title', 'نتائج البحث عن عقارات')

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen pt-[35px]">
    <section class="w-full bg-white">
        <div class="space-y-4 px-6">
            <!-- Top row: Filters and View Toggle -->
            <div class="flex flex-col-reverse items-center justify-between gap-4">
                
                <!-- Filters Container -->
                <div class="flex flex-wrap items-center w-full gap-3 justify-between">
                    {{-- Note: The custom dropdowns are complex and need more JS. 
                         For now, we'll use standard dropdowns that are functional. --}}
                    
                    {{-- Simplified, functional filters --}}
                    <form action="{{ route('properties.search') }}" method="GET" class="flex flex-wrap items-center w-full gap-3 justify-between">
                        <select name="city_id" class="custom-select-arrow px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm font-normal">
                            <option value="">كل المدن</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        
                        <select name="property_type_id" class="custom-select-arrow px-5 py-3.5 bg-[rgba(249,249,249,1)] rounded-lg text-sm font-normal">
                            <option value="">كل أنواع العقارات</option>
                             @foreach($propertyTypes as $propertyType)
                                <option value="{{ $propertyType->id }}" {{ request('property_type_id') == $propertyType->id ? 'selected' : '' }}>{{ $propertyType->name }}</option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="px-5 py-3.5 bg-indigo-600 text-white rounded-lg">تطبيق الفلتر</button>
                        <a href="{{ route('properties.search') }}" class="text-sm text-indigo-600 underline">مسح الفلتر</a>
                    </form>
                </div>
                
                <!-- View Toggle (Functionality can be added later) -->
                <div id="view-toggle" class="inline-flex p-1 bg-gray-200 rounded-full self-end">
                    <button class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full bg-[rgba(48,63,125,1)] text-white">
                        <img src="{{ asset('images/list.svg') }}">
                        <span>قائمة</span>
                    </button>
                    <button class="view-toggle-btn flex items-center gap-2 p-3 text-sm font-semibold rounded-full text-gray-600">
                        <img src="{{ asset('images/map.svg') }}">
                        <span>خريطة</span>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-6 pt-6 px-3">
            <div class="flex items-end justify-between">
                <div>
                     <p class="text-sm text-gray-500 mb-1 px-3">نتائج البحث:</p>
                     <div class="flex items-center gap-3">
                        <h2 class="text-3xl font-normal text-[rgba(48,62,124,1)]">العقارات المتاحة</h2>
                        <span class="text-xs font-medium bg-gray-200 text-[rgba(48,62,124,1)] px-1.5 py-0.5 border-[0.5px] border-[rgba(48,62,124,1)] bg-[rgba(48,62,124,0.06)] rounded-md">{{ $properties->total() }}</span>
                     </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-4 gap-6 mt-8 place-items-center">
            @forelse ($properties as $property)
                <div class="bg-white border border-gray-100 rounded-xl w-[320px] flex-shrink-0 snap-start shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <!-- Image Section -->
                        <div class="relative">
                            <img src="{{ $property->getFirstMediaUrl('images', 'thumb') ?: 'https://placehold.co/400x300' }}" class="w-full h-48 object-cover rounded-lg" alt="{{ $property->title }}">
                            <div class="absolute top-0 left-4 bg-white text-[rgba(48,62,124,1)] text-sm font-medium px-3.5 py-1.5 rounded-b">{{ $property->listing_purpose }}</div>
                            <button class="absolute top-2.5 right-3 bg-[rgba(255,255,255,0.27)] p-1.5 rounded-lg hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[rgba(242,242,242,1)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>
                            </button>
                        </div>
                        <!-- Details Section -->
                        <div class="p-3 space-y-[23px]">
                            <div class="flex justify-between items-center text-xs text-[rgba(204,204,204,1)]">
                                <span class="flex items-center gap-0.5 font-semibold text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[rgba(48,62,124,1)]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                    {{ $property->district?->city?->name }} - {{ $property->district?->name ?? 'حي غير محدد' }}
                                </span>
                                <span class="flex items-center gap-0.5">
                                    <img src="{{ asset('images/clock.svg') }}">
                                    {{ $property->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="text-lg font-bold text-slate-800 leading-tight">{{ $property->title }}</h3>
                                <p class="text-xs text-slate-500">{{ Str::limit($property->description, 100) }}</p>
                            </div> 
                            <div class="flex gap-2 text-sm">
                                <span class="flex items-center gap-1 bg-gray-100 text-slate-600 px-2 py-1 rounded-md"><img src="{{ asset('images/building.svg') }}" class="h-4 w-4"> {{ $property->propertyType->name }}</span>
                                {{-- You can add more attributes here if they exist on the model --}}
                            </div>
                            <div class="border-t border-gray-100 pt-5 mt-5 flex justify-between items-center">
                                <p class="text-lg font-bold text-indigo-700">{{ number_format($property->total_price) }} <span class="text-xs font-medium text-slate-500">ر.س</span></p>
                                <a href="#" class="bg-[rgba(48,62,124,1)] text-white text-sm font-semibold px-6 py-2.5 rounded-lg hover:bg-indigo-800">رؤية التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">لا توجد عقارات تطابق بحثك.</p>
            @endforelse
        </div>

        <div class="flex justify-center items-center py-[60px]">
            {{ $properties->links() }}
        </div>
    </section>
</main>
@endsection