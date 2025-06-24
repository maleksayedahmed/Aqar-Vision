@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">Create New Property</h3></div>
        <form action="{{ route('admin.properties.store') }}" method="POST">
            @csrf
            @include('admin.properties._form', ['property' => null])
        </form>
    </div>
@endsection
