@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('attributes.agents.messages.edit') }}</div>
                    <form method="POST" action="{{ route('admin.agents.update', $agent->id) }}">
                        @csrf
                        @method('PUT')
                        @include('admin.agents._form', ['agent' => $agent])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 