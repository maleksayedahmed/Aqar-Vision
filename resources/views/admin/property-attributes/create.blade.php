@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_attributes.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-attributes.store') }}" method="POST">
                        @csrf
                        @include('admin.property-attributes._form', ['propertyAttribute' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection