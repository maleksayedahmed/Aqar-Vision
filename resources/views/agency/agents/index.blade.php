@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Manage Your Agents</h5>
        <a href="{{ route('agency.agents.create') }}" class="btn btn-primary btn-sm">Add New Agent</a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ads Count</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($agents as $agent)
                    <tr>
                        <td>{{ $agent->full_name }}</td>
                        <td>{{ $agent->user->email }}</td>
                        <td>{{ $agent->phone_number }}</td>
                        <td>{{ $agent->ads_count }}</td>
                        <td>
                            @if($agent->user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('agency.agents.edit', $agent) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No agents found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $agents->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection