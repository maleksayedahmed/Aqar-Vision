@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_attributes.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-attributes.update', $propertyAttribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.property-attributes._form', ['propertyAttribute' => $propertyAttribute])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection