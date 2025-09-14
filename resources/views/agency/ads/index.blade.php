@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Manage Agent Ads</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Ad Details</th>
                    <th>Agent</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($ads as $ad)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if(!empty($ad->images) && is_array($ad->images) && !empty($ad->images[0]))
                                    <img src="{{ Storage::url($ad->images[0]) }}" class="avatar avatar-sm me-3">
                                @else
                                    <img src="https://via.placeholder.com/100" class="avatar avatar-sm me-3">
                                @endif
                                <span class="text-sm">{{ $ad->title }}</span>
                            </div>
                        </td>
                        <td>{{ $ad->user->name }}</td>
                        <td>
                            <span class="badge @if($ad->status == 'active') bg-success @elseif($ad->status == 'pending') bg-warning @else bg-danger @endif">
                                {{ $ad->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('agency.ads.edit', $ad) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No ads found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $ads->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection