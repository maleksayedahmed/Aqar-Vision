@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Filters</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.properties.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Title..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="city" class="form-control" placeholder="Search by City..." value="{{ request('city') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="">-- All Statuses --</option>
                                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="property_type_id" class="form-control">
                                        <option value="">-- All Types --</option>
                                        @foreach($propertyTypes as $type)
                                            <option value="{{ $type->id }}" {{ request('property_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->getTranslation('name', app()->getLocale()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Properties</h6>
                        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">Create Property</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($properties as $property)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 px-3">{{ $property->title }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $property->propertyType?->getTranslation('name', app()->getLocale()) }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-info">{{ $property->status }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $property->user?->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="text-secondary font-weight-bold text-xs">Edit</a>
                                                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center py-4">No properties found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($properties->hasPages())
                        <div class="card-footer">
                            {{ $properties->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
