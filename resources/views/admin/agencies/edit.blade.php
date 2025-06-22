@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agencies.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.agencies.update', $agency->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.agencies._form', ['agency' => $agency])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection