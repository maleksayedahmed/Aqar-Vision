@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <form action="{{ route('agency.agents.update', $agent) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card-header"><strong>Edit Agent: {{ $agent->full_name }}</strong></div>
        <div class="card-body">
            @include('agency.agents.partials._form', ['agent' => $agent])
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection