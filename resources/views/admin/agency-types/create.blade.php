@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agency_types.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.agency-types.store') }}" method="POST">
                        @csrf
                        @include('admin.agency-types._form', ['agencyType' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection