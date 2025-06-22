@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agents.messages.create') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.agent-types.store') }}">
                        @csrf
                        @include('admin.agent-types._form', ['agentType' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 