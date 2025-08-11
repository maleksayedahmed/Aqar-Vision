@extends('layouts.app')

@section('title', 'حسابي')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
    <div class="flex flex-col lg:flex-row gap-4">

        <!-- User Sidebar Navigation -->
        @include('partials.user_sidebar')

        <!-- Main Content Form -->
        <main class="w-full bg-white p-6 sm:p-8 sm:pr-11 rounded-xl shadow-sm relative">

            {{-- Success Message --}}
            @if (session('status') === 'profile-updated')
                <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg" role="alert">
                    <p>تم حفظ التغييرات بنجاح!</p>
                </div>
            @endif

            <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div x-data="{photoName: null, photoPreview: null}">
                    <!-- Profile Header -->
                    <div class="mb-10 flex flex-col gap-y-6 sm:flex-row sm:justify-between items-start">
                        <div class="relative flex items-center gap-x-4 sm:gap-x-[45px]">
                            
                            <!-- Profile Picture -->
                            <div class="w-24 h-24 sm:w-28 sm:h-28">
                                <img x-show="!photoPreview" src="{{ $user->profile_photo_path ? Storage::url($user->profile_photo_path) : asset('images/profile.png') }}" alt="صورة الملف الشخصي" class="w-full h-full rounded-full object-cover border-4 border-black shadow-md">
                                <span x-show="photoPreview" class="block w-full h-full rounded-full bg-cover bg-no-repeat bg-center border-4 border-black shadow-md"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>
                            
                            <!-- Camera Button -->
                            <div class="absolute top-[70px] sm:top-[80px]">
                                <label for="profile_photo" class="bg-[#303E7C] text-white w-[42px] h-[30px] flex items-center justify-center rounded-full hover:bg-opacity-90 transition-colors cursor-pointer" aria-label="تغيير الصورة">
                                    <img src="{{ asset('images/camera-profile.svg') }}">
                                </label>
                                <input type="file" name="profile_photo" id="profile_photo" class="hidden"
                                       x-ref="photo"
                                       x-on:change="
                                           photoName = $refs.photo.files[0].name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => { photoPreview = e.target.result; };
                                           reader.readAsDataURL($refs.photo.files[0]);
                                       ">
                            </div>

                            <div class="flex flex-col gap-[15px]">
                                <p class="bg-[rgba(27,177,105,0.09)] text-[rgba(27,177,105,1)] text-[14px] font-medium inline-block px-4 py-1.5 rounded-full mb-2 self-start">حساب عام</p>
                                <h1 class="text-xl sm:text-[26px] font-medium text-black">{{ $user->name }}</h1>
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 px-2 sm:px-9 gap-x-6 gap-y-6">

                        <div>
                            <label for="name" class="block text-[11px] font-medium mb-2">الاسم</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                   class="w-full h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-[11px] font-medium mb-2">ادخل رقم الهاتف</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required
                                       class="w-full pl-[100px] h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 flex items-center px-3 pointer-events-none gap-2">
                                    <div class="h-6 border-l border-gray-300"></div>
                                    <img src="{{ asset('images/saudi_flag.png') }}" alt="Saudi Arabia Flag" class="w-6 h-4 object-cover">
                                    <span class="text-gray-600 font-medium">+966</span>
                                </div>
                            </div>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="fal_license" class="block text-[11px] font-medium mb-2">رخصة فال</label>
                            <input type="text" id="fal_license" name="fal_license" value="{{ old('fal_license', optional($user->agent)->license_number) }}"
                                   class="w-full md:w-[405px] h-[50px] text-[11px] font-medium border border-gray-200 text-gray-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#303F7C] focus:border-transparent">
                            @error('fal_license')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        
                    </div>

                    <div class="mt-10 text-center">
                        <button type="submit" class="bg-[#303E7C] text-[19px] text-white font-medium py-3 px-16 rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                            حفظ التغييرات
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</section>

<!-- CTA Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 py-4 mt-4">
    <div class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[225px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-8 lg:p-4">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>
        <div class="relative z-10 flex flex-col items-center text-center">
            <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">
            <h2 class="text-[15px] font-bold text-[rgba(26,26,26,1)] mb-2">هل انت عقاري؟</h2>
            <p class="max-w-3xl text-[15px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                إذا كنت وسيطًا عقاريًا أو لديك عدد كبير من العقارات، قم بترقية حسابك إلى حساب عقاري للاستفادة من باقات متعددة للإعلانات وميزات إدارة متقدمة حول نوع الحساب وابدأ الرحلة.
            </p>
            <a href="#" class="bg-[#303F7C] text-white font-bold py-3 px-12 rounded-lg hover:bg-opacity-90 transition-colors shadow-md">
                تحويل الحساب
            </a>
        </div>
    </div>
</section>
</main>

@endsection