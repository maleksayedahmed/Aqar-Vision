@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">@lang('admin.cities.edit_city')</h3></div>
                <form action="{{ route('admin.cities.update', $city) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.cities._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection