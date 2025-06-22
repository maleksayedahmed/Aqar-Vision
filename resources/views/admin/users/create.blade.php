@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.users.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        @include('admin.users._form', ['user' => null, 'roles' => $roles])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection