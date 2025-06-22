@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.license_types.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.license-types.update', $licenseType->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.license-types._form', ['licenseType' => $licenseType])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection