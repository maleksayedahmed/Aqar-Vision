@extends('agency.layouts.app')

@section('agency-content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Notifications</h5>
        </div>
        <div class="card-body">
            @livewire('agency.notifications')
        </div>
    </div>
@endsection
