@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_types.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-types.store') }}" method="POST">
                        @csrf
                        @include('admin.property-types._form', [
                            'propertyType' => null, 
                            'parentTypes' => $parentTypes, 
                            'attributes' => $attributes,
                            'selectedAttributes' => []
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection