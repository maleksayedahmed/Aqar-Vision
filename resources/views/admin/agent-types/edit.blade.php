@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agents.messages.edit') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.agent-types.update', $agentType->id) }}">
                        @csrf
                        @method('PUT')
                        @include('admin.agent-types._form', ['agentType' => $agentType])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 