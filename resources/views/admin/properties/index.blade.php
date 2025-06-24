@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Properties</h3>
            <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">Create Property</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>User</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->propertyType?->name }}</td>
                        <td><span class="badge bg-info">{{ $property->status }}</span></td>
                        <td>{{ $property->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.properties.edit', $property->id) }}">Edit</a>
                            <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No properties found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $properties->links() }}</div>
    </div>
@endsection
