@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <form action="{{ route('agency.agents.store') }}" method="POST">
        @csrf
        <div class="card-header"><strong>Create a New Agent</strong></div>
        <div class="card-body">
            @include('agency.agents.partials._form', ['agent' => new \App\Models\Agent()])
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Agent</button>
        </div>
    </form>
</div>
@endsection