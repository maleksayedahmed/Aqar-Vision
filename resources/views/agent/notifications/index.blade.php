@extends('layouts.agent')

@section('title', __('common.notifications'))

@section('content')

    <main class="py-10 bg-[rgba(250,250,250,1)]">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
            <div class="flex flex-col w-full lg:flex-row gap-4">

                <!-- Sidebar Navigation -->
                @include('partials.agent_sidebar')

                <!-- Notifications Section -->
                <section class="w-full h-full">
                    {{-- This is where the Livewire component will be rendered --}}
                    @livewire('agent.notifications')
                </section>
            </div>
        </section>
    </main>
@endsection
