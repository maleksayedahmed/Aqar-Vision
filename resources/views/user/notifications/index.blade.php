@extends('layouts.app')

@section('title', __('common.notifications'))

@section('content')
<main class="py-10 bg-[rgba(250,250,250,1)]">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
        <div class="flex flex-col w-full lg:flex-row gap-4">

            <!-- User Sidebar Navigation -->
            @include('partials.user_sidebar')

            <!-- Feedback Section -->
            {{-- The padding and background of this section now match the agent's page --}}
            <section class="w-full rounded-xl bg-white shadow-sm">
                @livewire('user.notifications')
            </section>
        </div>
    </section>
</main>
@endsection
