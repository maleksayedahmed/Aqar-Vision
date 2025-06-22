@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_purposes.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-purposes.update', $propertyPurpose->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.property-purposes._form', ['propertyPurpose' => $propertyPurpose])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection