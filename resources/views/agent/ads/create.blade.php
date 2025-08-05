@extends('layouts.agent')

@section('title', 'اختر نوع رخصة الإعلان')

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="flex justify-center px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-[250px] lg:flex-shrink-0">
                <div class="bg-white p-4 rounded-xl shadow-sm h-full">
                    <nav>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('agent.profile.edit') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-gray-100 font-normal text-[16px] transition-colors">
                                    <img src="{{ asset('images/account.svg') }}">
                                    <span>حسابي</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent.my-ads') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg bg-[rgba(48,62,124,0.09)] text-[rgba(48,62,124,1)] text-[16px] transition-colors">
                                    <img src="{{ asset('images/ads.svg') }}">
                                    <span>إعلاناتي</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-gray-100 text-[16px] transition-colors">
                                    <img src="{{ asset('images/bell.svg') }}">
                                    <span>الاشعارات</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent.about-us') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-gray-100 text-[16px] transition-colors">
                                    <img src="{{ asset('images/about.svg') }}">
                                    <span>من نحن</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent.terms-of-use') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-gray-100 text-[16px] transition-colors">
                                    <img src="{{ asset('images/use.svg') }}">
                                    <span>شروط الاستخدام</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('agent.complaints.create') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-gray-100 text-[16px] transition-colors">
                                    <img src="{{ asset('images/complain.svg') }}">
                                    <span>تقديم الشكاوي</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg hover:bg-red-50 text-red-500 text-[16px] transition-colors">
                                        <img src="{{ asset('images/log-out.svg') }}">
                                        <span>تسجيل الخروج</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Pricing Section -->
            <section class="h-full w-full">
                <div class="">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        <!-- Section Header -->
                        <div class="text-center mb-12">
                            <h2 class="text-[24.5px] font-bold text-[rgba(48,62,124,1)]">اختر نوع رخصة الإعلان</h2>
                            <p class="mt-4 text-[16.8px] max-w-2xl mx-auto text-[rgba(77,77,77,1)]">
                                اختر نوع الإعلان الذي يناسب عقارك واحتياجاتك. كل نوع يوفر مزايا مختلفة لضمان وصول إعلانك لأكبر عدد من المهتمين.
                            </p>
                        </div>

                        <!-- Pricing Cards Grid -->
                        <div class="flex flex-col items-center lg:flex-row lg:justify-center lg:items-start gap-8">
                            
                            @forelse ($adPrices as $price)
                                <div class="w-full max-w-sm lg:w-[300px] border border-gray-200 rounded-xl p-6 flex flex-col text-center">
                                    <div class="mb-6 flex justify-center">
                                        @if($price->type == 'normal')
                                            <img src="{{ asset('images/normal ad.png') }}" alt="اعلان عادي">
                                        @elseif($price->type == 'featured')
                                            <img src="{{ asset('images/second ad.png') }}" alt="اعلان مميز">
                                        @else
                                            <img src="{{ asset('images/diamond ad.png') }}" alt="اعلان استثنائي">
                                        @endif
                                    </div>
                                    <h3 class="text-[17.6px] font-medium text-[rgba(3,33,110,1)] mb-3">{{ $price->name }}</h3>
                                    <p class="text-[14.7px] text-[rgba(153,153,153,1)] font-semibold leading-relaxed flex-grow mb-6">
                                        {{ $price->description }}
                                    </p>
                                    <div class="mb-6 flex gap-2 items-center justify-center">
                                        <span class="text-[23.8px] font-semibold">{{ (int)$price->price }}</span>
                                        <img src="{{ asset('images/royal.png') }}" class="h-[20px] w-[20px]" alt="ريال">
                                    </div>
                                    <div class="bg-[rgba(79,171,232,0.1)] border border-[rgba(79,171,232,1)] rounded-lg p-3 flex items-center justify-between mb-6">
                                        <span class="text-[11.8px]">إضافة عرض على الخريطة (<span class="text-[rgba(79,171,232,1)]">+100 ريال</span>)</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                        </label>
                                    </div>
                                    <a href="{{ route('agent.ads.create.step1', $price) }}" class="w-full bg-[rgba(48,62,124,1)] text-[14.7px] text-white font-normal py-2 rounded-md hover:bg-opacity-90 transition-colors mt-auto">
                                        اشترك الآن
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-10 col-span-full">
                                    <p class="text-gray-500">لا توجد باقات إعلانية متاحة حالياً.</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection