@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">Edit Property: {{ $property->title }}</h3></div>
        <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.properties._form', ['property' => $property])
        </form>
    </div>
@endsection
