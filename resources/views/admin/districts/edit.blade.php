@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Edit District</h3></div>
                <form action="{{ route('admin.districts.update', $district) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.districts._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection