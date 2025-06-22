@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.roles.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        @include('admin.roles._form', ['role' => null, 'rolePermissions' => []])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection