@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.ad_prices.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.ad-prices.store') }}" method="POST">
                        @csrf
                        @include('admin.ad-prices._form', ['adPrice' => null])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
