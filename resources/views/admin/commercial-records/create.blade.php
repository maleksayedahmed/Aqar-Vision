@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.commercial_records.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.commercial-records.store') }}" method="POST">
                        @csrf
                        @include('admin.commercial-records._form', [
                            'commercialRecord' => null,
                            'agencies' => $agencies,
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
