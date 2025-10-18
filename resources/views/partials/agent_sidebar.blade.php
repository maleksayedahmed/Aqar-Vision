{{-- resources/views/partials/agent_sidebar.blade.php --}}
<aside class="w-full lg:w-[250px] lg:flex-shrink-0">
    <div class="bg-white p-4 rounded-xl shadow-sm h-full">
        <nav>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('agent.profile.edit') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] font-normal text-[16px] transition-colors {{ request()->routeIs('agent.profile.edit') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/account.svg') }}">
                        <span>{{ __('common.my_account') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.my-ads') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('agent.my-ads') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/ads.svg') }}">
                        <span>{{ __('common.my_ads') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.notifications') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('agent.notifications') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <div class="relative">
                            <img src="{{ asset('images/bell.svg') }}">
                            @livewire('agent.notification-counter')
                        </div>
                        <span>{{ __('common.notifications') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.about-us') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('agent.about-us') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/about.svg') }}">
                        <span>{{ __('common.about_us') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.terms-of-use') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] font-normal text-[16px] transition-colors {{ request()->routeIs('agent.terms-of-use') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/use.svg') }}">
                        <span>{{ __('common.terms_of_use') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('agent.complaints.create') }}"
                        class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg text-[rgba(48,62,124,1)] hover:bg-[rgba(48,62,124,0.09)] text-[16px] transition-colors {{ request()->routeIs('agent.complaints.create') ? 'bg-[rgba(48,62,124,0.09)]' : '' }}">
                        <img src="{{ asset('images/complain.svg') }}">
                        <span>{{ __('common.submit_complaints') }}</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center gap-[10px] p-3 px-4 sm:px-10 rounded-lg hover:bg-red-50 text-red-500 text-[16px] transition-colors">
                            <img src="{{ asset('images/log-out.svg') }}">
                            <span>{{ __('common.log_out') }}</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
