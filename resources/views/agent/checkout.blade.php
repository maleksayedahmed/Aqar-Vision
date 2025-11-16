@extends('layouts.agent')

@section('title', __('common.checkout'))

@section('content')
    <main class="flex lg:px-20 px-4 flex-col items-center lg:min-h-screen pt-[60px] pb-8 lg:pb-[140px]">
        <section class="pb-10 w-full max-w-4xl mx-auto">
            <div class="text-center">
                <h2 class="text-2xl md:text-[32px] font-medium text-[rgba(48,62,124,1)] mb-4">
                    {{ __('common.checkout') }}</h2>
                <p class="max-w-3xl mx-auto text-[rgba(77,77,77,1)] leading-relaxed">
                    {{ __('common.complete_your_purchase') }}</p>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                    <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)]">
                        {{ $plan->name }}
                    </h3>
                    <p class="text-3xl md:text-[31.3px] my-4 font-medium text-[rgba(26,26,26,1)]">
                        {{ $plan->price_monthly }}<span class="text-base md:text-[16.6px]">/{{ __('common.monthly') }}</span>
                    </p>
                    <ul class="mt-8 space-y-4 text-sm font-medium text-gray-700">
                        @foreach($plan->features ?? [] as $feature)
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                    <h3 class="text-xl md:text-[23.3px] font-medium text-[rgba(3,33,110,1)] mb-6">
                        {{ __('common.payment_details') }}
                    </h3>
                    <form action="{{ route('agent.subscribe') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <div class="space-y-4">
                            <div>
                                <label for="card_number" class="block text-sm font-medium text-gray-700">{{ __('common.card_number') }}</label>
                                <input type="text" id="card_number" name="card_number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="xxxx xxxx xxxx xxxx">
                            </div>
                            <div>
                                <label for="expiry_date" class="block text-sm font-medium text-gray-700">{{ __('common.expiry_date') }}</label>
                                <input type="text" id="expiry_date" name="expiry_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="MM/YY">
                            </div>
                            <div>
                                <label for="cvc" class="block text-sm font-medium text-gray-700">{{ __('common.cvc') }}</label>
                                <input type="text" id="cvc" name="cvc" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="CVC">
                            </div>
                        </div>
                        <button type="submit" class="w-full mt-8 bg-[rgba(48,62,124,1)] text-white text-lg md:text-[21.3px] font-medium py-3 text-center rounded-lg hover:bg-opacity-90 transition-colors">
                            {{ __('common.pay_now') }}
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
