@extends('layouts.agent')

@section('title', 'أضف اعلان جديد - الخطوة 2')

@section('content')
<main class="bg-[rgba(250,250,250,1)] px-4 lg:px-20 pt-6 pb-11">

    <form method="POST" action="{{ route('agent.ads.store') }}" enctype="multipart/form-data">
        @csrf

        <section class="">
            <div class="flex w-full flex-col items-stretch gap-y-4 lg:flex-row lg:items-center lg:justify-between py-4" dir="rtl">
                <a href="{{ route('agent.ads.create.step1', $selectedAdPrice) }}" class="flex items-center gap-x-3">
                    <img src="{{ asset('images/back-arrow.svg') }}">
                    <div class="text-right">
                        <h3 class="text-2xl lg:text-[26px] font-medium text-[rgba(48,62,124,1)]">أضف اعلان جديد</h3>
                        <p class="text-[14.3px] font-medium"><span class="mr-1 text-red-500">*</span>نرجو تعبئة البيانات بدقة</p>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-x-[27px]">
                    <span class="font-medium text-[16px] text-[rgba(181,183,191,1)]">بيانات العقار</span>
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('images/rode.svg') }}">
                    </div>
                    <span class="font-medium text-[16px] text-[rgba(48,62,124,1)]">مستندات العقار</span>
                </div>

                <div class="relative w-full lg:w-[264px]">
                    <button type="button" class="flex items-center justify-between bg-[rgba(0,0,0,0.02)] w-full h-[53px] px-4 py-2.5 rounded-xl text-lg lg:text-[20px] font-medium text-black">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ asset('images/star.png') }}">
                            <span>{{ $selectedAdPrice->name }}</span>
                        </div>
                        <img src="{{ asset('images/Polygon.svg') }}">
                    </button>
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

            <div class="bg-[rgba(243,246,255,1)] p-4 md:p-6 rounded-lg border-r-4 border-[rgba(98,150,209,1)]">
                <div class="text-gray-800 space-y-4 text-[16.3px] font-medium">
                    <p class="font-bold text-lg">إرشادات هامة لرفع الوسائط:</p>
                    <div>
                        <p class="font-bold mb-2">• الصور:</p>
                        <ul class="space-y-2 pr-4 md:pr-6 text-[rgba(48,62,124,1)]">
                            <li>• يُفضل رفع صور عالية الجودة وواضحة للعقار من زوايا مختلفة.</li>
                            <li>• تأكد من أن الصور مضاءة جيدًا ولا تحتوي على علامات مائية أو نصوص إضافية.</li>
                            <li>• الأبعاد الموصى بها: 1280x720 بكسل أو أعلى.</li>
                            <li>• الحد الأقصى لحجم الصورة: 5 ميجابايت.</li>
                            <li>• يمكنك تعيين صورة رئيسية واحدة ستظهر كأول صورة للإعلان.</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-bold mb-2 mt-4">• الفيديوهات:</p>
                        <ul class="space-y-2 pr-4 md:pr-6 text-[rgba(48,62,124,1)]">
                            <li>• يمكنك رفع فيديو واحد للعقار يعرض تفاصيله بشكل أفضل.</li>
                            <li>• يجب أن يكون الفيديو قصيرًا وواضحًا (لا يزيد عن دقيقة).</li>
                            <li>• تأكد من جودة الصوت والصورة.</li>
                            <li>• صيغ الفيديو المدعومة: MP4, MOV, WebM.</li>
                            <li>• الحد الأقصى لحجم الفيديو: 50 ميجابايت.</li>
                        </ul>
                    </div>
                    <p class="text-[rgba(48,62,124,1)]">لا تتردد في حذف أي وسائط غير مرغوب فيها باستخدام زر (X).</p>
                </div>
            </div>

            <div class="mt-8">
                <div id="drop-zone" class="flex h-36 w-full items-center justify-center rounded-xl border-2 border-dashed border-gray-300 transition-colors">
                    <label for="file-upload" class="cursor-pointer text-center text-base text-gray-400 sm:text-lg">
                        اسحب الصور والفيديوهات وأفلتها هنا، أو
                        <span class="font-semibold text-sky-500 hover:text-sky-600">انقر للتحميل</span>
                        <input id="file-upload" name="images[]" type="file" class="sr-only" multiple accept="image/*,video/*">
                    </label>
                </div>
                <div class="mt-6 border-b border-gray-200">
                    <nav class="-mb-px flex gap-x-4 sm:gap-x-8" aria-label="Tabs">
                        <button type="button" data-type="image" class="tab-btn whitespace-nowrap border-b-2 border-sky-500 px-1 py-4 text-base font-medium text-sky-500 sm:text-lg" aria-current="page">الصور</button>
                        <button type="button" data-type="video" class="tab-btn whitespace-nowrap border-b-2 border-transparent px-1 py-4 text-base font-medium text-gray-500 hover:text-gray-700 sm:text-lg">الفيديوهات</button>
                    </nav>
                </div>
                <div id="thumbnail-container" class="mt-6 flex flex-wrap justify-center gap-4 sm:justify-end">
                    <!-- JavaScript will insert thumbnails here -->
                </div>
            </div>
        </section>

        <div class="mt-8">
            <div class="relative flex items-start gap-x-3" dir="rtl">
                <div class="flex h-6 items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                </div>
                <div class="text-sm leading-6">
                    <label for="terms" class="block text-[14.25px] font-bold text-[rgba(13,18,38,1)]">أقر بأن جميع المعلومات المقدمة صحيحة، وأتحمل المسؤولية الكاملة عنها.</label>
                    <p class="mt-1 text-[13px] font-medium text-[rgba(13,18,38,1)]">يرجى التأكد من دقة المعلومات المدخلة. فأنت تتحمل المسؤولية الكاملة عنها. قد يؤدي تقديم بيانات غير صحيحة <br> إلى رفض الطلب أو اتخاذ إجراءات قانونية.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-12">
            <button type="submit" class="flex items-center justify-center gap-x-2 bg-[rgba(48,62,124,1)] hover:bg-blue-800 text-white text-base sm:text-[19px] font-medium py-3 px-8 sm:px-16 w-full sm:w-auto rounded-lg transition-colors">
                <img src="{{ asset('images/publish.svg') }}">
                <span>نشر العقار</span>
            </button>
        </div>
    </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-upload');
    const thumbnailContainer = document.getElementById('thumbnail-container');
    const tabs = document.querySelectorAll('.tab-btn');

    let uploadedFiles = [];
    let activeTab = 'image'; // 'image' or 'video'

    // --- Event Listeners ---
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('border-sky-500', 'bg-sky-50'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-sky-500', 'bg-sky-50'), false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    // Handle file selection via browse button
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    // Handle tab switching
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Update active tab variable
            activeTab = tab.dataset.type;
            
            // Update tab visual styles
            tabs.forEach(t => {
                t.classList.remove('border-sky-500', 'text-sky-500');
                t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700');
                t.removeAttribute('aria-current');
            });
            tab.classList.add('border-sky-500', 'text-sky-500');
            tab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700');
            tab.setAttribute('aria-current', 'page');

            // Re-render thumbnails for the new active tab
            renderThumbnails();
        });
    });

    // --- Core Functions ---

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        const newFiles = [...files].filter(file => {
            return file.type.startsWith('image/') || file.type.startsWith('video/');
        });

        if (newFiles.length > 0) {
            uploadedFiles = [...uploadedFiles, ...newFiles];
            renderThumbnails();
        }
    }
    
    function renderThumbnails() {
        thumbnailContainer.innerHTML = ''; // Clear existing thumbnails
        const filesToRender = uploadedFiles.filter(file => file.type.startsWith(activeTab + '/'));

        filesToRender.forEach(file => {
            const fileURL = URL.createObjectURL(file);

            // Create main container div
            const thumbDiv = document.createElement('div');
            thumbDiv.className = 'relative h-24 w-32 shrink-0';

            // Create image or video element
            let mediaElement;
            if (file.type.startsWith('image/')) {
                mediaElement = document.createElement('img');
            } else { // It's a video
                mediaElement = document.createElement('video');
                // For videos, we show the first frame. Muted and playsinline are good practices.
                mediaElement.muted = true;
                mediaElement.playsinline = true;
                mediaElement.addEventListener('loadeddata', () => mediaElement.pause()); // Ensure it shows the first frame
            }
            mediaElement.className = 'h-full w-full rounded-lg object-cover';
            mediaElement.src = fileURL;
            
            // Create delete button
            const deleteButton = document.createElement('button');
            deleteButton.className = 'absolute right-1.5 top-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-white transition-colors hover:bg-red-600';
            deleteButton.innerHTML = `<svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>`;
            
            deleteButton.addEventListener('click', () => {
                // Remove file from array
                uploadedFiles = uploadedFiles.filter(f => f !== file);
                // Revoke the object URL to free up memory
                URL.revokeObjectURL(fileURL);
                // Re-render the thumbnails
                renderThumbnails();
            });

            // Assemble and append
            thumbDiv.appendChild(mediaElement);
            thumbDiv.appendChild(deleteButton);
            thumbnailContainer.appendChild(thumbDiv);
        });
    }
});
</script>

 <!-- 3. JavaScript to control the modal -->
  <script>
    // Get the elements from the DOM
    const publishBtn = document.getElementById('publishBtn');
    const successModal = document.getElementById('successModal');
    const viewAdBtn = document.getElementById('viewAdBtn');

    // Function to show the modal
    function showModal() {
      successModal.classList.remove('hidden');
    }

    // Function to hide the modal
    function hideModal() {
      successModal.classList.add('hidden');
    }

    // --- Event Listeners ---

    // When the "Publish" button is clicked, show the modal
    publishBtn.addEventListener('click', showModal);

    // When the "View Ad" button inside the modal is clicked, hide the modal
    // (In a real app, this might navigate to another page first)
    viewAdBtn.addEventListener('click', hideModal);
    
    // Optional: Close the modal if the user clicks on the dark background overlay
    successModal.addEventListener('click', (event) => {
      // Check if the click was on the background (the modal element itself)
      if (event.target === successModal) {
        hideModal();
      }
    });

  </script>
@endsection