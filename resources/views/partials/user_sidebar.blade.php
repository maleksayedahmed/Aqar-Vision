{{-- resources/views/partials/user_sidebar.blade.php --}}
<aside class="w-full lg:w-[250px] lg:flex-shrink-0">
    <div class="bg-white p-4 rounded-xl shadow-sm h-full">
        <nav>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('user.profile.edit') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] font-normal text-[16px] transition-colors {{ request()->routeIs('user.profile.edit') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/account.svg') }}">
                        <span>حسابي</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.my-ads') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('user.my-ads') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/ads.svg') }}">
                        <span>إعلاناتي</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('user.notifications') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('user.notifications') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/bell.svg') }}">
                        <span>الاشعارات</span>
                        @livewire('user.notification-counter')
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('user.about-us') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('user.about-us') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/about.svg') }}">
                        <span>من نحن</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.terms') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] font-normal text-[16px] transition-colors {{ request()->routeIs('user.terms') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/use.svg') }}">
                        <span>شروط الاستخدام</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.complaints.create') }}" class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('user.complaints.create') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
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