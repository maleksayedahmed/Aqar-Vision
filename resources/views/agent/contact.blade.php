{{-- resources/views/agent/contact.blade.php --}}

@extends('layouts.agent')

@section('title', 'الباقات')

@section('content')

    <main class="flex lg:px-20 px-4  flex-col items-center lg:min-h-screen pt-[60px] pb-8 lg:pb-[140px]">

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">نجاح!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<!-- Contact Section -->
<section>
    <div class="max-w-7xl mx-auto pb-10">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-[24.5px] font-semibold text-[rgba(48,62,124,1)]">تواصل معنا</h2>
            <p class="mt-3 text-[16.8px] text-[rgba(77,77,77,1)]">هل لديك أي استفسارات أو ملاحظات؟ فقط أرسل لنا رسالة!</p>
        </div>

        <!-- Main Content Grid -->
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- Right Side: Contact Info -->
            <div class="font-madani bg-white w-full lg:w-[307px] lg:flex-shrink-0 rounded-2xl shadow-sm p-8">
                <h3 class="text-[17px] font-bold text-[rgba(48,62,124,1)] mb-8">معلومات التواصل</h3>
                    <div class="space-y-10">
                        <!-- Phone -->
                        <div class="text-center">
                            <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/call.svg') }}" alt="">
                                <span>رقم الجوال</span>
                            </p>    
                            <p class="flex items-center gap-2 text-sky-500 mt-2">
                                <span>0509777655</span>
                                <button>
                                    <img src="{{ asset('images/copy.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                         <!-- Email -->
                        <div class="text-center">
                             <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/email.svg') }}" alt="">
                                <span>البريد الالكتروني</span>
                            </p>
                            <p class="flex items-center gap-2 text-sky-500 mt-2">
                                <span>aqarvition@gmail.com</span> 
                                <button>
                                    <img src="{{ asset('images/copy.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                         <!-- Location -->
                        <div class="">
                            <p class="flex items-center gap-2 text-[rgba(48,62,124,1)]">
                                <img src="{{ asset('images/location-contact.svg') }}" alt="">
                                <span>الموقع</span>
                            </p>
                            <p class="text-sky-500 mt-2">الرياض</p>
                             <p class="flex items-center gap-2 text-sky-500 mt-1 text-sm">
                                <span>شارع نجد - حي ظهرة لبن</span>
                                <button>
                                <img src="{{ asset('images/link.svg') }}" alt="">
                                </button>
                            </p>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="text-center gap-[12px] mt-10">
                        <p class=" text-gray-[rgba(26,26,26,1)] mb-4 text-[14px]"> تابـعونا علــي</p>
                        <div class="flex flex-row-reverse items-center justify-center gap-4">
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/youtube-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/tiktok-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/insta-dark.svg') }}" alt="">
                            </a>
                            <a href="#" class="text-gray-700 hover:text-black transition-colors">
                                <img src="{{ asset('images/fb-dark.svg') }}" alt="">
                            </a>

                        </div>
                    </div>
            </div>
            
            <!-- Left Side: Form -->
            <div class="font-madani bg-white w-full rounded-2xl shadow-sm p-8">
                {{-- Make sure the form points to the correct POST route --}}
                <form method="POST" action="{{ route('agent.contact.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    @csrf
                    <!-- Inputs... (make sure they have `name` attributes) -->
                     <!-- Name -->
                        <div>
                            <label for="name" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">الاسم</label>
                            <input type="text" id="name" name="name" placeholder="ادخل الاسم" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-full py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">رقم الجوال</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" placeholder="ادخل رقم الجوال" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-full py-3 px-5 text-right pr-14 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Flag" class="w-6 h-auto">
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[14.2px] font-medium text-[rgba(26,26,26,1)] mb-2">البريد الالكتروني</label>
                            <input type="email" id="email" name="email" placeholder="ادخل البريد الالكتروني" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-full py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                         <!-- Service Type -->
                        <div>
                            <label for="service_type" class="block text-[14.2px] text-[rgba(26,26,26,1)] mb-2">نوع الخدمة</label>
                            <input type="text" id="service_type" name="service_type" placeholder="اختيار نوع الخدمة" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-full py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]">
                        </div>
                        <!-- Message -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-[14.2px] text-[rgba(26,26,26,1)] mb-2">الرسالة (اختياري)</label>
                            <textarea id="message" name="message" rows="5" placeholder="ادخل الرساله (اختياري)" class="text-[14.2px] w-full bg-[#F9F9F9] text-gray-500 rounded-3xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-[#303F7C]"></textarea>
                        </div>
                    <!-- Submit Button -->
                    <div class="md:col-span-2 text-center pt-3">
                        <button type="submit" class="text-[17px] bg-[rgba(48,62,124,1)] text-white py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm flex items-center justify-center gap-2 mx-auto">
                            <img src="{{ asset('images/send-white.svg') }}" class="w-[18px]" alt="">
                            <span>ارسال</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

    </main>
@endsection
