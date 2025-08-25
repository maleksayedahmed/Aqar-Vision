@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">{{ __('attributes.subscriptions.edit') }}</h3></div>
        <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.subscriptions._form', ['subscription' => $subscription])
        </form>
    </div>
@endsection
