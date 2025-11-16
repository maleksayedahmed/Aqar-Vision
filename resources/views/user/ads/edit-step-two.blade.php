@extends('layouts.app')

@section('title', __('common.edit_media') . ' - ' . __('common.step_2'))

@push('styles')
    <link href="https://releases.transloadit.com/uppy/v3.1.0/uppy.min.css" rel="stylesheet">
@endpush

@section('content')
<main class="bg-gray-50 px-4 lg:px-20 pt-6 pb-11">

    @if ($errors->any())
       <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
           <strong class="font-bold">{{ __('common.please_fix_errors') }}</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
    $routePrefix = Auth::user()->agent ? 'agent.ads.' : 'user.ads.';
    @endphp

    <form method="POST" action="{{ route($routePrefix .'update', $ad) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- This hidden input will be populated by Uppy with the new video's path --}}
        <input type="hidden" name="video" id="video-path">

        <section class="mt-6 bg-white p-4 md:p-8 rounded-xl shadow-sm" dir="rtl">
            <h2 class="text-lg font-bold mb-6">{{ __('common.edit_images_and_video') }}</h2>

            {{-- Existing Images --}}
            @if(!empty($ad->images))
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700">{{ __('common.current_images') }}</label>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4 mt-2">
                    @foreach($ad->images as $image)
                    <div class="relative group">
                        <label for="delete_image_{{ $loop->index }}" class="cursor-pointer">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-colors flex items-center justify-center">
                                <input type="checkbox" name="delete_images[]" value="{{ $image }}" id="delete_image_{{ $loop->index }}" class="h-5 w-5 rounded text-red-500 focus:ring-red-400">
                            </div>
                             <img src="{{ Storage::url($image) }}" class="w-full h-32 object-cover rounded-lg">
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add New Images --}}
            <div class="mb-8">
                <label for="images" class="block text-sm font-medium text-gray-700">{{ __('common.upload_new_images') }}</label>
                <input type="file" name="images[]" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                 @error('images.*') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <hr>

            {{-- Existing Video --}}
            @if($ad->video_path)
             <div class="mb-8 mt-8">
                <label class="block text-sm font-medium text-gray-700">{{ __('common.current_video') }}</label>
                <video src="{{ Storage::url($ad->video_path) }}" controls class="w-full max-w-md rounded-lg mt-2"></video>
                <div class="mt-2">
                    <input type="checkbox" name="delete_video" value="1" id="delete_video" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
                    <label for="delete_video" class="text-sm text-red-600 font-medium">{{ __('common.delete_current_video') }}</label>
                </div>
            </div>
            @endif

            {{-- Uppy Video Uploader --}}
            <div class="mt-8">
                <label class="block text-sm font-medium text-gray-700">{{ $ad->video_path ? __('common.upload_new_video') : __('common.upload_video') }}</label>
                <div id="video-uploader" class="mt-2"></div>
                <div id="uppy-error-message" class="text-red-500 text-xs mt-2"></div>
            </div>
        </section>

        {{-- Terms Checkbox --}}
        <div class="mt-8">
            <div class="relative flex items-start gap-x-3" dir="rtl">
                <div class="flex h-6 items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                </div>
                <div class="text-sm leading-6">
                    <label for="terms" class="block text-[14.25px] font-bold">{{ __('common.confirm_all_info_correct') }}</label>
                </div>
            </div>
             @error('terms') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-center mt-12">
            <button type="submit" id="submit-button" class="bg-blue-800 text-white font-bold py-3 px-16 rounded-lg hover:bg-blue-700 disabled:opacity-50">
                {{ __('common.save_and_finish') }}
            </button>
        </div>
    </form>
</main>
@endsection

@push('scripts')
<script type="module">
  import { Uppy, Dashboard, XHRUpload }
    from "https://releases.transloadit.com/uppy/v3.1.0/uppy.min.mjs";
  import ar_SA from "https://unpkg.com/@uppy/locales/lib/ar_SA.js";

  const submitButton = document.getElementById('submit-button');
  const videoPathInput = document.getElementById('video-path');
  const uppyErrorMessage = document.getElementById('uppy-error-message');

  const uppy = new Uppy({
      id: 'videoEditorUploader',
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
    note: '{{ __('common.uppy_video_note', ['size' => 50]) }}',
      hideUploadButton: true,
  });

  uppy.use(XHRUpload, {
      endpoint: '{{ route("user.ads.uploadVideo") }}',
      fieldName: 'video',
      headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json',
      }
  });

  uppy.on('file-added', () => {
      submitButton.disabled = true;
      submitButton.classList.add('opacity-50', 'cursor-not-allowed');
      uppyErrorMessage.textContent = '';
  });

  uppy.on('upload-success', (file, response) => {
      videoPathInput.value = response.body.url ?? response.body.path;
      submitButton.disabled = false;
      submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
      console.log('Uppy upload successful:', response.body);
  });

  uppy.on('file-removed', () => {
      videoPathInput.value = '';
      submitButton.disabled = false;
      submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
  });

    uppy.on('upload-error', (file, error, response) => {
      console.error('Uppy upload error:', { error, response });
    uppyErrorMessage.textContent = '{{ __('common.video_upload_failed', ['size' => 50]) }}';
      submitButton.disabled = false;
      submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
  });

  uppy.on('restriction-failed', (file, error) => {
      uppyErrorMessage.textContent = error.message;
  });
</script>
@endpush

