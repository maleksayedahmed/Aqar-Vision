@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agency_types.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.agency-types.update', $agencyType->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.agency-types._form', ['agencyType' => $agencyType])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection