@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_types.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-types.update', $propertyType->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.property-types._form', [
                            'propertyType' => $propertyType, 
                            'parentTypes' => $parentTypes, 
                            'attributes' => $attributes, 
                            'selectedAttributes' => $selectedAttributes
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection