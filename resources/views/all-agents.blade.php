@extends('layouts.app')

@section('title', 'وسطاء العقاريون')

@section('content')

<main class="flex flex-col items-center justify-start min-h-screen pt-[35px]">
    <!-- Hero Section -->
    <section class="w-[98%] h-[280px] rounded-[20px] shadow-[0_100px_100px_-60px_rgba(0,0,0,0.2)] mb-8">
        <div class="flex text-center w-[100%] h-[280px] rounded-[20px] items-center flex-col bg-[linear-gradient(89.78deg,rgba(44,63,128,0)_0.27%,#4461A6_66.85%,#2C3F80_99.9%)] bg-cover bg-center pt-[40px] pb-[40px]" style="background-image: linear-gradient(89.78deg, rgba(44,63,128,0) 0.27%, #4461A6 66.85%, #2C3F80 99.9%), url('{{ asset('images/homebanner.jpg') }}');">
            <img src="{{ asset('images/logo_sm.png') }}" width="30px" alt="logo">

            <!-- Main Title -->
            <div>
                <h1 class="text-[42px] md:text-5xl font-bold text-white mb-4">
                    وسطاء و مسوقين عقاريين
                </h1>

                <!-- Subtitle -->
                <p class="text-white/90 text-[14px] md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                    تواصل مع أفضل وسطاء العقارات المحترفين في المملكة<br>
                    خبراء يساعدونك في العثور على العقار المثالي
                </p>
            </div>
        </div>
    </section>



    <!-- Search and Filter Section -->
    <section class="max-w-7xl w-full mx-auto py-8 px-4">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">البحث والتصفية</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <input type="text" id="agent-search" placeholder="ابحث عن وسيط..." class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div>
                    <select id="city-filter" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">جميع المدن</option>
                        @foreach($agents->pluck('agent.city')->filter()->unique('id') as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="ads-count-filter" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">جميع الوسطاء</option>
                        <option value="1-5">1-5 عقارات</option>
                        <option value="6-15">6-15 عقار</option>
                        <option value="16+">أكثر من 15 عقار</option>
                    </select>
                </div>
                <div>
                    <select id="sort-filter" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="name">ترتيب حسب الاسم</option>
                        <option value="ads_count">ترتيب حسب عدد العقارات</option>
                        <option value="newest">الأحدث</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Agents Grid Section -->
    <section class="max-w-7xl w-full mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-8">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-slate-800 md:text-3xl">جميع وسطاء العقارات</h2>
                <p class="text-xs sm:text-sm text-slate-500">
                    {{ $agents->count() }} وسيط عقاري معتمد جاهز لخدمتك
                </p>
            </div>
            <div class="flex items-center gap-2">
                <button id="grid-view" class="p-2 rounded-lg bg-indigo-100 text-indigo-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </button>
                <button id="list-view" class="p-2 rounded-lg text-gray-400 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Grid View -->
        <div id="agents-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($agents as $agent)
                <div class="agent-card bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 overflow-hidden"
                     data-name="{{ strtolower($agent->name) }}"
                     data-city="{{ $agent->agent?->city?->id ?? '' }}"
                     data-ads-count="{{ $agent->ads_count }}">

                    <!-- Agent Header -->
                    <div class="relative p-6 bg-gradient-to-br from-indigo-50 to-blue-50">
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                مسوق عقاري
                            </span>
                        </div>

                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-4">
                                <img src="{{ $agent->profile_photo_path ? Storage::url($agent->profile_photo_path) : asset('images/agent.png') }}"
                                     alt="{{ $agent->name }}"
                                     class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                                <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $agent->name }}</h3>

                            <div class="flex items-center gap-1 text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                            </div>

                            <div class="flex items-center gap-1 text-sm text-indigo-600 font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                </svg>
                                <span>{{ $agent->ads_count }} عقار</span>
                            </div>
                        </div>
                    </div>

                    <!-- Agent Actions -->
                    <div class="p-4 space-y-3">
                        <div class="grid grid-cols-2 gap-2">
                            <a href="tel:{{ $agent->phone }}"
                               class="flex items-center justify-center gap-2 bg-indigo-600 text-white text-sm font-medium py-2.5 px-3 rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>اتصال</span>
                            </a>

                            <a href="{{ route('agents.show', $agent) }}"
                               class="flex items-center justify-center gap-2 border border-gray-300 text-gray-700 text-sm font-medium py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>تفاصيل</span>
                            </a>
                        </div>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone) }}"
                           class="flex items-center justify-center gap-2 bg-green-500 text-white text-sm font-medium py-2.5 px-4 rounded-lg hover:bg-green-600 transition-colors w-full">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.386"/>
                            </svg>
                            <span>واتساب</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا يوجد وسطاء عقاريون</h3>
                    <p class="text-gray-500">لا يوجد وسطاء عقاريون متاحون حالياً.</p>
                </div>
            @endforelse
        </div>

        <!-- List View (Hidden by default) -->
        <div id="agents-list" class="hidden space-y-4">
            @forelse($agents as $agent)
                <div class="agent-card bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 p-4 md:p-6"
                     data-name="{{ strtolower($agent->name) }}"
                     data-city="{{ $agent->agent?->city?->id ?? '' }}"
                     data-ads-count="{{ $agent->ads_count }}">

                    <!-- Mobile Layout (sm and below) -->
                    <div class="flex flex-col space-y-4 md:hidden">
                        <!-- Agent Info Row -->
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="{{ $agent->profile_photo_path ? Storage::url($agent->profile_photo_path) : asset('images/agent.png') }}"
                                     alt="{{ $agent->name }}"
                                     class="w-14 h-14 rounded-full object-cover border-2 border-gray-200">
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-bold text-gray-900 truncate">{{ $agent->name }}</h3>
                                <div class="flex flex-col gap-1 text-xs text-gray-600 mt-1">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="truncate">{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3 text-indigo-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        <span class="text-indigo-600 font-medium">{{ $agent->ads_count }} عقار</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex-shrink-0">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                    مسوق عقاري
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons Row -->
                        <div class="grid grid-cols-3 gap-2">
                            <a href="tel:{{ $agent->phone }}"
                               class="flex items-center justify-center gap-1 bg-indigo-600 text-white text-xs font-medium py-2 px-2 rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>اتصال</span>
                            </a>

                            <a href="{{ route('agents.show', $agent) }}"
                               class="flex items-center justify-center gap-1 border border-gray-300 text-gray-700 text-xs font-medium py-2 px-2 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>تفاصيل</span>
                            </a>

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone) }}"
                               class="flex items-center justify-center gap-1 bg-green-500 text-white text-xs font-medium py-2 px-2 rounded-lg hover:bg-green-600 transition-colors">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.386"/>
                                </svg>
                                <span>واتساب</span>
                            </a>
                        </div>
                    </div>

                    <!-- Desktop Layout (md and above) -->
                    <div class="hidden md:flex md:items-center md:justify-between">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="{{ $agent->profile_photo_path ? Storage::url($agent->profile_photo_path) : asset('images/agent.png') }}"
                                     alt="{{ $agent->name }}"
                                     class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                                <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $agent->name }}</h3>
                                <div class="flex items-center gap-4 text-sm text-gray-600 mt-1">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 20l-4.95-6.05a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ $agent->agent?->city?->name ?? 'غير محدد' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        <span class="text-indigo-600 font-medium">{{ $agent->ads_count }} عقار</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="tel:{{ $agent->phone }}"
                               class="flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span>اتصال</span>
                            </a>

                            <a href="{{ route('agents.show', $agent) }}"
                               class="flex items-center gap-2 border border-gray-300 text-gray-700 text-sm font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition-colors">
                                <span>عرض التفاصيل</span>
                            </a>

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->phone) }}"
                               class="flex items-center justify-center w-10 h-10 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.386"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">لا يوجد وسطاء عقاريون</h3>
                    <p class="text-gray-500">لا يوجد وسطاء عقاريون متاحون حالياً.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination (if needed) -->
        @if($agents->count() > 12)
        <div class="mt-12 flex justify-center">
            <div class="flex items-center gap-2">
                <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">السابق</button>
                <button class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-indigo-600 rounded-lg">1</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">التالي</button>
            </div>
        </div>
        @endif
    </section>

    <!-- Call to Action Section -->
    <section class="my-16 flex justify-center px-4">
        <div class="w-full lg:w-[1120px] text-center p-6 md:p-8 lg:p-12 rounded-2xl bg-cover bg-center" style="background-image: url('{{ asset('images/world.png') }}'); background-color: rgba(68, 112, 174, 1);">

            <h2 class="text-white text-2xl md:text-3xl lg:text-4xl font-bold mb-6">
                هل أنت وسيط عقاري محترف؟
            </h2>

            <p class="text-white/90 text-base lg:text-lg mb-8 max-w-3xl mx-auto font-medium leading-relaxed">
                انضم إلى منصتنا وابدأ في عرض عقاراتك للوصول إلى آلاف العملاء المحتملين. سجل الآن واحصل على حساب مجاني للبدء في رحلتك المهنية معنا.
            </p>

            <a href="#" class="inline-block bg-[#2C3F80] text-white font-semibold py-3 px-10 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">
                انضم كوسيط عقاري
            </a>

        </div>
    </section>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const gridViewBtn = document.getElementById('grid-view');
    const listViewBtn = document.getElementById('list-view');
    const agentsGrid = document.getElementById('agents-grid');
    const agentsList = document.getElementById('agents-list');

    gridViewBtn.addEventListener('click', function() {
        agentsGrid.classList.remove('hidden');
        agentsList.classList.add('hidden');
        gridViewBtn.classList.add('bg-indigo-100', 'text-indigo-600');
        gridViewBtn.classList.remove('text-gray-400', 'hover:bg-gray-100');
        listViewBtn.classList.remove('bg-indigo-100', 'text-indigo-600');
        listViewBtn.classList.add('text-gray-400', 'hover:bg-gray-100');
    });

    listViewBtn.addEventListener('click', function() {
        agentsList.classList.remove('hidden');
        agentsGrid.classList.add('hidden');
        listViewBtn.classList.add('bg-indigo-100', 'text-indigo-600');
        listViewBtn.classList.remove('text-gray-400', 'hover:bg-gray-100');
        gridViewBtn.classList.remove('bg-indigo-100', 'text-indigo-600');
        gridViewBtn.classList.add('text-gray-400', 'hover:bg-gray-100');
    });

    // Search and filter functionality
    const searchInput = document.getElementById('agent-search');
    const cityFilter = document.getElementById('city-filter');
    const adsCountFilter = document.getElementById('ads-count-filter');
    const sortFilter = document.getElementById('sort-filter');

    function filterAndSortAgents() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCity = cityFilter.value;
        const selectedAdsCount = adsCountFilter.value;
        const sortBy = sortFilter.value;

        // Get all agent cards from both views
        const allAgentCards = document.querySelectorAll('.agent-card');
        let visibleCards = [];

        allAgentCards.forEach(card => {
            const name = card.dataset.name;
            const city = card.dataset.city;
            const adsCount = parseInt(card.dataset.adsCount);

            let isVisible = true;

            // Search filter
            if (searchTerm && !name.includes(searchTerm)) {
                isVisible = false;
            }

            // City filter
            if (selectedCity && city !== selectedCity) {
                isVisible = false;
            }

            // Ads count filter
            if (selectedAdsCount) {
                if (selectedAdsCount === '1-5' && (adsCount < 1 || adsCount > 5)) {
                    isVisible = false;
                } else if (selectedAdsCount === '6-15' && (adsCount < 6 || adsCount > 15)) {
                    isVisible = false;
                } else if (selectedAdsCount === '16+' && adsCount < 16) {
                    isVisible = false;
                }
            }

            if (isVisible) {
                card.style.display = '';
                visibleCards.push(card);
            } else {
                card.style.display = 'none';
            }
        });

        // Sort visible cards
        if (sortBy && visibleCards.length > 0) {
            const gridContainer = document.getElementById('agents-grid');
            const listContainer = document.getElementById('agents-list');

            visibleCards.sort((a, b) => {
                if (sortBy === 'name') {
                    return a.dataset.name.localeCompare(b.dataset.name);
                } else if (sortBy === 'ads_count') {
                    return parseInt(b.dataset.adsCount) - parseInt(a.dataset.adsCount);
                } else if (sortBy === 'newest') {
                    // For newest, you'd need to add a data-created attribute
                    return 0; // For now, maintain current order
                }
                return 0;
            });

            // Reorder grid cards
            const gridCards = visibleCards.filter(card => card.closest('#agents-grid'));
            gridCards.forEach(card => {
                gridContainer.appendChild(card);
            });

            // Reorder list cards
            const listCards = visibleCards.filter(card => card.closest('#agents-list'));
            listCards.forEach(card => {
                listContainer.appendChild(card);
            });
        }
    }

    // Add event listeners for filters
    searchInput.addEventListener('input', filterAndSortAgents);
    cityFilter.addEventListener('change', filterAndSortAgents);
    adsCountFilter.addEventListener('change', filterAndSortAgents);
    sortFilter.addEventListener('change', filterAndSortAgents);

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush
