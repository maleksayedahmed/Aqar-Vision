@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.roles.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.roles._form', ['role' => $role, 'rolePermissions' => $rolePermissions])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection