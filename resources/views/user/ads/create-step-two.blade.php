@extends('layouts.app')

@section('title', 'أضف اعلان جديد - الخطوة 2')

@push('styles')
    {{-- Uppy's CSS is required for the video uploader's UI --}}
    <link href="https://releases.transloadit.com/uppy/v3.1.0/uppy.min.css" rel="stylesheet">
@endpush

@section('content')
<main class="bg-[rgba(250,250,250,1)] px-4 lg:px-20 pt-6 pb-11">

    @php
    $routePrefix = Auth::user() && Auth::user()->agent ? 'agent.ads.' : 'user.ads.';
    @endphp
    {{-- The form now needs the enctype for the standard image uploads --}}
    <form id="ad-step-two-form" method="POST" action="{{ route($routePrefix . 'store') }}" enctype="multipart/form-data">
        @csrf
        
        {{-- This hidden input will be populated by Uppy with the uploaded video's path --}}
        <input type="hidden" name="video" id="video-path">

        <section class="">
            <div class="flex w-full flex-col items-stretch gap-y-4 lg:flex-row lg:items-center lg:justify-between py-4" dir="rtl">
                <a href="{{ route('user.ads.create.step1', $selectedAdPrice) }}" class="flex items-center gap-x-3">
                    <img src="{{ asset('images/back-arrow.svg') }}" alt="Back Arrow">
                    <div class="text-right">
                        <h3 class="text-2xl lg:text-[26px] font-medium text-[rgba(48,62,124,1)]">أضف اعلان جديد</h3>
                        <p class="text-[14.3px] font-medium"><span class="mr-1 text-red-500">*</span>نرجو تعبئة البيانات بدقة</p>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-x-[27px]">
                    <span class="font-medium text-[16px] text-[rgba(181,183,191,1)]">بيانات العقار</span>
                    <div class="flex items-center gap-x-2"><img src="{{ asset('images/rode-active.svg') }}"></div>
                    <span class="font-medium text-[16px] text-[rgba(48,62,124,1)]">مستندات العقار</span>
                </div>
                <div class="relative w-full lg:w-[264px]">
                    <div class="flex items-center justify-between bg-[rgba(0,0,0,0.02)] w-full h-[53px] px-4 py-2.5 rounded-xl text-lg lg:text-[20px] font-medium text-black">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ $selectedAdPrice->icon_path ? Storage::url($selectedAdPrice->icon_path) : asset('images/star.png') }}" alt="Ad Type Icon" class="w-8 h-8">
                            <span>{{ $selectedAdPrice->name }}</span>
                        </div>
                        <img src="{{ asset('images/Polygon.svg') }}" alt="Dropdown Arrow">
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-6 bg-white p-4 md:p-8 rounded-xl shadow-[0px_4px_23px_rgba(0,0,0,0.05)]" dir="rtl">
            <div class="flex items-center ml-[-16px] md:ml-0 md:mr-[-32px] gap-3 mb-10">
                <div class="bg-[rgba(48,62,124,1)] p-2 rounded-tl-xl rounded-bl-xl">
                    <img src="{{ asset('images/plaza.svg') }}">
                </div>
                <h2 class="text-base lg:text-[18px] font-bold">صور وفيديوهات العقار</h2>
            </div>

            {{-- ** THIS IS THE RESTORED INSTRUCTIONS BLOCK ** --}}
            <div class="bg-[rgba(243,246,255,1)] p-4 md:p-6 rounded-lg border-r-4 border-[rgba(98,150,209,1)] mb-8">
                <div class="text-gray-800 space-y-4 text-[16.3px] font-medium">
                    <p class="font-bold text-lg">إرشادات هامة لرفع الوسائط:</p>
                    <div>
                        <p class="font-bold mb-2">• الصور:</p>
                        <ul class="space-y-2 pr-4 md:pr-6 text-[rgba(48,62,124,1)]">
                            <li>• يُفضل رفع صور عالية الجودة وواضحة للعقار من زوايا مختلفة.</li>
                            <li>• الحد الأقصى لحجم الصورة: 5 ميجابايت.</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-bold mb-2 mt-4">• الفيديوهات:</p>
                        <ul class="space-y-2 pr-4 md:pr-6 text-[rgba(48,62,124,1)]">
                            <li>• يمكنك رفع فيديو واحد فقط للعقار.</li>
                            <li>• صيغ الفيديو المدعومة: MP4, MOV, WebM.</li>
                            <li>• الحد الأقصى لحجم الفيديو: 50 ميجابايت.</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Standard Image Upload --}}
            <div class="mb-8">
                <label for="images" class="block text-sm font-medium text-gray-700">صور العقار (يمكنك اختيار عدة صور)</label>
                <input type="file" name="images[]" id="images" multiple class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                @error('images.*') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <hr>

            {{-- Uppy Video Upload Area --}}
            <div class="mt-8">
                <label class="block text-sm font-medium text-gray-700">فيديو العقار (فيديو واحد فقط)</label>
                <div id="video-uploader" class="mt-2"></div>
                <div id="uppy-error-message" class="text-red-500 text-xs mt-2"></div>
            </div>
        </section>

        <div class="mt-8">
            <div class="relative flex items-start gap-x-3" dir="rtl">
                <div class="flex h-6 items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                </div>
                <div class="text-sm leading-6">
                    <label for="terms" class="block text-[14.25px] font-bold">أقر بأن جميع المعلومات المقدمة صحيحة.</label>
                </div>
            </div>
            @error('terms') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center mt-12">
            <button type="submit" id="submit-button" class="flex items-center justify-center gap-x-2 bg-[rgba(48,62,124,1)] text-white text-lg font-medium py-3 px-16 rounded-lg transition-colors disabled:opacity-50">
                <span>نشر العقار</span>
            </button>
        </div>
    </form>
</main>
@endsection

@push('scripts')
    <script type="module">
        import { Uppy, Dashboard, XHRUpload } from "https://releases.transloadit.com/uppy/v3.1.0/uppy.min.mjs";
        import ar_SA from "https://esm.sh/@uppy/locales/lib/ar_SA.js";

        const submitButton = document.getElementById('submit-button');
        const videoPathInput = document.getElementById('video-path');
        const uppyErrorMessage = document.getElementById('uppy-error-message');

        const uppy = new Uppy({
            id: 'videoUploader',
            autoProceed: true,
            locale: ar_SA,
            restrictions: {
                maxNumberOfFiles: 1,
                maxFileSize: 51200 * 1024, // 50MB
                allowedFileTypes: ['video/*']
            }
        });

        uppy.use(Dashboard, {
            inline: true,
            target: '#video-uploader',
            height: 300,
            proudlyDisplayPoweredByUppy: false,
            note: 'فيديو واحد فقط، أقصى حجم 50 ميجابايت',
            hideUploadButton: true,
        });

        uppy.use(XHRUpload, {
            endpoint: '{{ route("user.ads.uploadVideo") }}',
            fieldName: 'video',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        });

        uppy.on('file-added', (file) => {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            uppyErrorMessage.textContent = '';
        });

        uppy.on('upload-success', (file, response) => {
            videoPathInput.value = response.body.path;
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            console.log('Uppy upload successful:', response.body.path);
            
        });

        uppy.on('file-removed', (file) => {
            videoPathInput.value = '';
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
        });

        uppy.on('upload-error', (file, error, response) => {
            console.error('Uppy upload error:', { error, response });
            uppyErrorMessage.textContent = 'فشل رفع الفيديو. يرجى التأكد من أن حجمه أقل من 50 ميجابايت.';
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
        });

        uppy.on('restriction-failed', (file, error) => {
            uppyErrorMessage.textContent = error.message;
        });
    </script>
@endpush