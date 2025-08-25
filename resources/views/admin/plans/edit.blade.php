@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">{{ __('attributes.plans.edit') }}</h3></div>
        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.plans._form', ['plan' => $plan])
        </form>
    </div>
@endsection
