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
                    <form action="{{ route('admin.ads.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Search by Title..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="city_id" class="form-control">
                                    <option value="">-- All Cities --</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">-- All Statuses --</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">All Ads</h6>
                    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary btn-sm">Create New Ad</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agent</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ads as $ad)
                                    <tr>
                                        <td><p class="text-xs font-weight-bold mb-0 px-3">{{ $ad->title }}</p></td>
                                        <td><p class="text-xs font-weight-bold mb-0">{{ $ad->district?->city?->name }} - {{ $ad->district?->name }}</p></td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm 
                                                @if($ad->status == 'active') bg-gradient-success
                                                @elseif($ad->status == 'pending') bg-gradient-warning
                                                @else bg-gradient-secondary @endif">
                                                {{ ucfirst($ad->status) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $ad->user?->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-secondary font-weight-bold text-xs">Edit</a>
                                                <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center py-4">No ads found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($ads->hasPages())
                    <div class="card-footer">
                        {{ $ads->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection