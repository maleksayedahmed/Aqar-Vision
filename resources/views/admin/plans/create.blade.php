@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">{{ __('attributes.plans.create') }}</h3></div>
        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            @include('admin.plans._form', ['plan' => null])
        </form>
    </div>
@endsection
