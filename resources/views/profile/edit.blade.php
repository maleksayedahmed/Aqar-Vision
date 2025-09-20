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

                                <div id="agency_fields" class="space-y-6">
                                    <div>
                                        <x-input-label for="agency_name" value="Agency Name" />
                                        <x-text-input id="agency_name" name="agency_name" type="text" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="agency_type_id" value="Agency Type" />
                                        <select id="agency_type_id" name="agency_type_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            @foreach($agencyTypes as $agencyType)
                                                <option value="{{ $agencyType->id }}">{{ $agencyType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <x-input-label for="commercial_register_number" value="Commercial Register Number" />
                                        <x-text-input id="commercial_register_number" name="commercial_register_number" type="text" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="commercial_issue_date" value="Commercial Issue Date" />
                                        <x-text-input id="commercial_issue_date" name="commercial_issue_date" type="date" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="commercial_expiry_date" value="Commercial Expiry Date" />
                                        <x-text-input id="commercial_expiry_date" name="commercial_expiry_date" type="date" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="tax_id" value="Tax ID" />
                                        <x-text-input id="tax_id" name="tax_id" type="text" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="tax_issue_date" value="Tax Issue Date" />
                                        <x-text-input id="tax_issue_date" name="tax_issue_date" type="date" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="tax_expiry_date" value="Tax Expiry Date" />
                                        <x-text-input id="tax_expiry_date" name="tax_expiry_date" type="date" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="address" value="Address" />
                                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="phone_number" value="Phone Number" />
                                        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" value="Email" />
                                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" />
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Submit Request') }}</x-primary-button>
                                </div>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const requestedRoleSelect = document.getElementById('requested_role');
                                    const agencyFieldsDiv = document.getElementById('agency_fields');

                                    function toggleAgencyFields() {
                                        console.log('Toggling agency fields. Current value:', requestedRoleSelect.value);
                                        const agencyInputs = agencyFieldsDiv.querySelectorAll('input, select, textarea');

                                        if (requestedRoleSelect.value === 'agency') {
                                            agencyFieldsDiv.style.display = 'block';
                                            agencyInputs.forEach(input => input.removeAttribute('disabled'));
                                        } else {
                                            agencyFieldsDiv.style.display = 'none';
                                            agencyInputs.forEach(input => input.setAttribute('disabled', 'true'));
                                        }
                                    }

                                    // Initial check on page load
                                    toggleAgencyFields();

                                    // Add event listener for changes
                                    requestedRoleSelect.addEventListener('change', toggleAgencyFields);
                                });
                            </script>

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