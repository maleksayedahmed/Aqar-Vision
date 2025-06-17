@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ad Prices</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ad-prices.create') }}" class="btn btn-primary btn-sm">
                            Add New Price
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Duration (Days)</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                                <tr>
                                    <td>{{ $price->getTranslation('name', app()->getLocale()) }}</td>
                                    <td>{{ number_format($price->price, 2) }}</td>
                                    <td>{{ $price->duration_days }}</td>
                                    <td>{{ ucfirst($price->type) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $price->is_active ? 'success' : 'danger' }}">
                                            {{ $price->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.ad-prices.edit', $price) }}" class="btn btn-sm btn-info">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.ad-prices.destroy', $price) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 