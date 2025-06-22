@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.property_purposes.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.property-purposes.store') }}" method="POST">
                        @csrf
                        @include('admin.property-purposes._form', ['propertyPurpose' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection