@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <form action="{{ route('agency.agents.store') }}" method="POST">
        @csrf
        <div class="card-header"><strong>@lang('agency.agents.create_a_new_agent')</strong></div>
        <div class="card-body">
            @include('agency.agents.partials._form', ['agent' => new \App\Models\Agent()])
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">@lang('agency.agents.create_agent')</button>
        </div>
    </form>
</div>
@endsection