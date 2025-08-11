@extends('layouts.app') {{-- Use the main app layout --}}

@section('title', 'شروط الاستخدام')

@section('content')

<main class="py-10 bg-gray-50">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
            @include('partials.user_sidebar')

            <!-- Main Content Section -->
            <section class="h-full w-full">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <section class="py-9">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-[53px]">
                            <div>
                                <div class="text-center mb-10">
                                    <h1 class="text-2xl font-bold text-gray-800 mb-2">شروط الاستخدام</h1>
                                    <p class="text-sm font-medium text-gray-500">تاريخ آخر تحديث: 19 يونيو 2025</p>
                                </div>

                                <p class="font-medium text-base leading-relaxed mb-12 max-w-4xl mx-auto text-center text-gray-700">
                                    أهلاً بك في <span class="text-indigo-700 font-bold">عقار فيجن!</span> يرجى قراءة شروط الاستخدام هذه بعناية قبل استخدام خدماتنا. تحدد هذه الشروط والأحكام حقوقك وواجباتك القانونية فيما يتعلق بوصولك واستخدامك لمنصتنا. باستخدامك لموقعنا، فإنك توافق على الالتزام بهذه الشروط. إذا كنت لا توافق على هذه الشروط، يرجى عدم استخدام خدماتنا.
                                </p>

                                <div class="bg-gray-50 border border-gray-200 p-8 mb-16 rounded-lg">
                                    <h2 class="text-lg font-bold text-indigo-700 mb-6">جدول المحتويات</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-4 text-gray-700 text-sm font-medium">
                                        <div class="space-y-3">
                                            <a href="#section-1" class="block hover:underline hover:text-indigo-600">1. قبول الشروط</a>
                                            <a href="#section-2" class="block hover:underline hover:text-indigo-600">2. التغييرات على الشروط</a>
                                            <a href="#section-3" class="block hover:underline hover:text-indigo-600">3. الحسابات والتسجيل</a>
                                            <a href="#section-4" class="block hover:underline hover:text-indigo-600">4. استخدام المنصة</a>
                                            <a href="#section-5" class="block hover:underline hover:text-indigo-600">5. محتوى المستخدم</a>
                                        </div>
                                        <div class="space-y-3">
                                            <a href="#section-6" class="block hover:underline hover:text-indigo-600">6. حقوق الملكية الفكرية</a>
                                            <a href="#section-7" class="block hover:underline hover:text-indigo-600">7. سياسة الخصوصية</a>
                                            <a href="#section-8" class="block hover:underline hover:text-indigo-600">8. أنظمة الدفع والاشتراك</a>
                                            <a href="#section-9" class="block hover:underline hover:text-indigo-600">9. إخلاء المسؤولية</a>
                                            <a href="#section-10" class="block hover:underline hover:text-indigo-600">10. التعويض</a>
                                        </div>
                                        <div class="space-y-3">
                                            <a href="#section-11" class="block hover:underline hover:text-indigo-600">11. إنهاء الحساب</a>
                                            <a href="#section-12" class="block hover:underline hover:text-indigo-600">12. القانون الواجب التطبيق</a>
                                            <a href="#section-13" class="block hover:underline hover:text-indigo-600">13. أحكام عامة</a>
                                            <a href="#section-14" class="block hover:underline hover:text-indigo-600">14. الاتصال بنا</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-12">
                                    <div id="section-1">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">1. قبول الشروط</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">
                                            باستخدامك لمنصة عقار فيجن، فإنك تقر بأنك قرأت وفهمت ووافقت على الالتزام بشروط الاستخدام هذه، بالإضافة إلى سياسة الخصوصية وأي إرشادات أو قواعد أخرى تنشر على الموقع. هذه الشروط سارية المفعول بينك وبين عقار فيجن.
                                        </p>
                                    </div>
                                    <div id="section-2">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">2. التغييرات على الشروط</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">
                                            تحتفظ عقار فيجن بالحق في تعديل أو تحديث هذه الشروط في أي وقت دون إشعار مسبق. سيتم نشر أي تغييرات على هذه الصفحة. استمرارك في استخدام المنصة بعد نشر التعديلات يعني موافقتك على الشروط المعدلة.
                                        </p>
                                    </div>
                                    <div id="section-3">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">3. الحسابات والتسجيل</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">
                                            أهلية المستخدم: يجب أن تكون مؤهلاً قانونياً لإبرام العقود لاستخدام خدماتنا.
                                            إنشاء الحساب: يتطلب الوصول إلى بعض الميزات إنشاء حساب. توافق على تقديم معلومات دقيقة وكاملة، وتحديثها عند الضرورة.
                                            مسؤولية الحساب: أنت مسؤول عن الحفاظ على سرية كلمة مرورك وأي نشاط يحدث تحت حسابك.
                                        </p>
                                    </div>
                                    <div id="section-4">
                                        <h3 class="text-lg font-bold text-indigo-700 mb-4">4. استخدام المنصة</h3>
                                        <p class="text-base font-medium leading-loose text-gray-700">
                                            توافق على استخدام المنصة بطريقة قانونية ومسؤولة، وعدم القيام بأي مما يلي: نشر معلومات كاذبة أو مضللة أو احتيالية. انتهاك حقوق الملكية الفكرية للآخرين. نشر محتوى مسيء أو فاحش أو تشهيري. محاولة الوصول غير المصرح به إلى الأنظمة أو البيانات. استخدام المنصة لأي غرض غير قانوني أو غير مصرح به.
                                        </p>
                                    </div>
                                    {{-- You can add the other sections here following the same pattern --}}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection