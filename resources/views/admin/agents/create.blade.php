@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agents.messages.create') }}</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.agents.store') }}">
                        @csrf
                        @include('admin.agents._form', ['agent' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 