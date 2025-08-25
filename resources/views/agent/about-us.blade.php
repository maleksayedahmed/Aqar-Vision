@extends('layouts.agent')

@section('title', 'من نحن')

@section('content')

<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="flex justify-center px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- Sidebar Navigation -->
           @include('partials.agent_sidebar')

            <!-- Main Content Section -->
            <section class="h-full w-full">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                        <div class="bg-[url('{{ asset('images/adsbanner.png') }}')] lg:h-[225px] bg-cover bg-center rounded-2xl shadow-sm overflow-hidden relative p-6 lg:p-8">
                            <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/bg-pattern.png') }}');"></div>
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <img src="{{ asset('images/logo.png') }}" class="w-[45px] h-[35px] mb-4" alt="logo">
                                <h2 class="text-[15px] font-bold text-[rgba(26,26,26,1)] mb-2">
                                    قصتنا: بناء جسور الثقة في عالم العقارات
                                </h2>
                                <p class="max-w-3xl text-[15px] mx-auto text-[rgba(102,102,102,1)] font-medium leading-relaxed mb-4">
                                    نحن في عقار فيجن نؤمن بأن كل عقار يحمل قصة، وكل بحث عن منزل هو رحلة نحو حلم. لذلك، نسعى لتقديم تجربة عقارية سهلة، شفافة، وفعالة للجميع.
                                </p>
                            </div>
                        </div>
                    </section>
                    <div class="p-6 md:p-10">
                        <div>
                            <h2 class="text-3xl md:text-[42px] font-bold text-[rgba(48,62,124,1)] mb-8">من نحن؟</h2>
                            <div class="font-medium text-[13.74px] text-[rgba(0,0,0,1)] leading-[30px]">
                                <div class="flex flex-col lg:flex-row gap-8 lg:gap-[80px]">
                                    <p>
                                        عقار فيجن هو منصة عقارية رائدة تهدف إلى ربط الباحثين عن العقارات بأفضل الفرص المتاحة في السوق. تأسس موقعنا على يد فريق من الخبراء الشغوفين بقطاع العقارات والتكنولوجيا، بهدف إحداث نقلة نوعية في طريقة البحث عن العقارات وعرضها في المملكة العربية السعودية.
                                        <br>
                                        منذ انطلاقتنا، التزمنا بتقديم أدوات مبتكرة وخدمات استثنائية لتمكين الأفراد والشركات العقارية على حد سواء. نحن نضع الشفافية والموثوقية في صميم كل ما نقدمه.
                                    </p>
                                    <img src="{{ asset('images/whous.jpg') }}" class="rounded-2xl w-full lg:w-[338px] lg:h-[206px] object-cover shrink-0 mt-4 lg:mt-0" alt="About Us Image">
                                </div>
                                <p class="mt-8">
                                    عقار فيجن هو منصة عقارية رائدة تهدف إلى ربط الباحثين عن العقارات بأفضل الفرص المتاحة في السوق. تأسس موقعنا على يد فريق من الخبراء الشغوفين بقطاع العقارات والتكنولوجيا، بهدف إحداث نقلة نوعية في طريقة البحث عن العقارات وعرضها في المملكة العربية السعودية.
                                    منذ انطلاقنا، التزمنا بتقديم أدوات مبتكرة وخدمات استثنائية لتمكين الأفراد والشركات العقارية على حد سواء. نحن نضع الشفافية والموثوقية في صميم كل ما نقدمه. عقار فيجن هو منصة عقارية رائدة تهدف إلى ربط الباحثين عن العقارات بأفضل الفرص المتاحة في السوق. تأسس موقعنا على يد فريق من الخبراء الشغوفين بقطاع العقارات والتكنولوجيا، بهدف إحداث نقلة نوعية في طريقة البحث عن العقارات وعرضها في المملكة العربية السعودية.
                                    منذ انطلاقنا، التزمنا بتقديم أدوات مبتكرة وخدمات استثنائية لتمكين الأفراد والشركات العقارية على حد سواء. نحن نضع الشفافية والموثوقية في صميم كل ما نقدمه.عقار فيجن هو منصة عقارية رائدة تهدف إلى ربط الباحثين عن العقارات بأفضل الفرص المتاحة في السوق. تأسس موقعنا على يد فريق من الخبراء الشغوفين بقطاع العقارات والتكنولوجيا، بهدف إحداث نقلة نوعية في طريقة البحث عن العقارات وعرضها في المملكة العربية السعودية.
                                    منذ انطلاقنا، التزمنا بتقديم أدوات مبتكرة وخدمات استثنائية لتمكين الأفراد والشركات العقارية على حد سواء. نحن نضع الشفافية والموثوقية في صميم كل ما نقدمه.
                                </p>
                            </div>
                        </div>
                    </div>
                    <section class="mt-10 flex justify-center ">
                        <div class="w-full text-center p-6 md:p-8 lg:p-12 bg-cover bg-center" style="background-image: url('{{ asset('images/world.png') }}'); background-color: rgba(68, 112, 174, 1);">
                            <h2 class="text-white text-2xl md:text-[27.2px] font-medium mb-5">
                                خلّك جاهـز وابـدأ رحلتـك فـي عـالم الـعقار الـيوم
                            </h2>
                            <p class="text-white/90 text-base md:text-[16.6px] mb-8 max-w-3xl mx-auto font-bold leading-relaxed">
                                سواء كنت تبحث عن عقارك المثالي أو ترغب في بيع أو تأجير ممتلكاتك، نحن هنا لمساعدتك.
                            </p>
                            <div class="flex flex-wrap justify-center gap-[14.2px]">
                                <a href="#" class="inline-block bg-white text-[rgba(48,62,124,1)] text-[15px] font-medium py-2 px-5 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">
                                   ابحث عن عقارك
                                </a>
                                <a href="#" class="inline-block bg-[rgba(26,36,76,1)] text-[15px] text-white font-medium py-2 px-5 rounded-full hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#4A6C9B] focus:ring-white">
                                    أضف عقار الآن
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </section>
</main>

@endsection