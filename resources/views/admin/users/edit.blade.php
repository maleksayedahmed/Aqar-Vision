@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.users.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.users._form', ['user' => $user, 'roles' => $roles])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection