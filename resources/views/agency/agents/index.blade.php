@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">@lang('agency.agents.manage_your_agents')</h5>
        <a href="{{ route('agency.agents.create') }}" class="btn btn-primary btn-sm">@lang('agency.agents.add_new_agent')</a>
        <a href="{{ route('agency.agents.invite') }}" class="btn btn-success btn-sm">@lang('agency.agents.invite_agent')</a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>@lang('agency.agents.name')</th>
                    <th>@lang('agency.agents.email')</th>
                    <th>@lang('agency.agents.phone')</th>
                    <th>@lang('agency.agents.ads_count')</th>
                    <th>@lang('agency.agents.status')</th>
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
                                <span class="badge bg-success">@lang('agency.agents.active')</span>
                            @else
                                <span class="badge bg-secondary">@lang('agency.agents.inactive')</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('agency.agents.edit', $agent) }}" class="btn btn-info btn-sm">@lang('agency.agents.edit')</a>
                            <form action="{{ route('agency.agents.removeFromAgency', $agent) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('@lang('agency.agents.remove_agent_confirmation')')">@lang('agency.agents.remove_from_agency')</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">@lang('agency.agents.no_agents_found')</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $agents->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection