@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">{{ __('attributes.subscriptions.create') }}</h3></div>
        <form action="{{ route('admin.subscriptions.store') }}" method="POST">
            @csrf
            @include('admin.subscriptions._form', ['subscription' => null])
        </form>
    </div>
@endsection
