@extends('admin.layouts.app') {{-- Reusing the admin layout for consistent styling --}}

@section('content')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('agency.layouts.header') {{-- Agency-specific header if needed --}}

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                
                @yield('agency-content')
            </div>
        </div>
        
        <footer class="footer">
            <div><a href="#">{{ auth()->user()->agency->agency_name ?? 'Agency' }}</a> © {{ date('Y') }}.</div>
        </footer>
    </div>
@endsection

@push('scripts')
    @stack('agency-scripts')
@endpush