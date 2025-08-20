@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Ad Packages</h3>
            <a href="{{ route('admin.ad-prices.create') }}" class="btn btn-primary btn-sm">Create New</a>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prices as $price)
                        <tr>
                            <td>
                                @if($price->icon_path)
                                    {{-- Use Storage::url() to get the correct public path --}}
                                    <img src="{{ Storage::url($price->icon_path) }}" alt="icon" class="avatar">
                                @else
                                    <span class="avatar" style="background-color: #eee"></span>
                                @endif
                            </td>
                            <td>{{ $price->name }}</td>
                            <td><span class="badge bg-secondary">{{ $price->type }}</span></td>
                            <td>{{ $price->price }} SAR</td>
                            <td>{{ $price->duration_days }} days</td>
                            <td>
                                @if($price->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.ad-prices.edit', $price) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.ad-prices.destroy', $price) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No ad packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $prices->links() }}
        </div>
    </div>
@endsection