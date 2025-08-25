<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- START: Added Upgrade Request Section --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Request Role Upgrade
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Request to upgrade your account to an Agent or Agency role to list properties.
                            </p>
                        </header>

                        {{-- Only show the form to basic users who do not already have a higher role --}}
                        @if(Auth::user()->hasRole('user'))

                            @if(session('success'))
                                <div class="mt-4 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="post" action="{{ route('user.upgrade.request') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="requested_role" value="I want to be an:" />
                                    <select id="requested_role" name="requested_role" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="agent">Agent</option>
                                        <option value="agency">Agency</option>
                                    </select>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Submit Request') }}</x-primary-button>
                                </div>
                            </form>
                        @else
                            <div class="mt-4 p-4 text-sm text-blue-700 bg-blue-100 rounded-lg" role="alert">
                                Your account role is currently: <strong>{{ Auth::user()->roles->first()->name ?? 'N/A' }}</strong>. No further upgrades are available.
                            </div>
                        @endif
                    </section>
                </div>
            </div>
            {{-- END: Added Upgrade Request Section --}}


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
