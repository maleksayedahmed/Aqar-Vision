@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">@lang('agency.agents.invite_an_agent')</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('agency.agents.invite') }}" method="GET">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="@lang('agency.agents.search_for_agents')" value="{{ $query ?? '' }}">
                <button type="submit" class="btn btn-primary">@lang('agency.agents.search')</button>
            </div>
        </form>
    </div>

    @if(isset($pendingInvitations) && $pendingInvitations->count())
        <div class="alert alert-info mt-3">
            <h6>@lang('agency.agents.pending_invitations')</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>@lang('agency.agents.name')</th>
                            <th>@lang('agency.agents.email')</th>
                            <th>@lang('agency.agents.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingInvitations as $invitation)
                            <tr>
                                <td>{{ $invitation->agent->user->name ?? '-' }}</td>
                                <td>{{ $invitation->agent->user->email ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('agency.agents.cancelInvitation', $invitation->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('@lang('agency.agents.cancel_invitation_confirmation')')">@lang('agency.agents.cancel_invitation')</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(isset($agents))
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>@lang('agency.agents.name')</th>
                        <th>@lang('agency.agents.email')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agentUser)
                        <tr>
                            <td>{{ $agentUser->name }}</td>
                            <td>{{ $agentUser->email }}</td>
                            <td>
                                @if($agentUser->agent)
                                    @if(in_array($agentUser->agent->id, $pendingAgentIds ?? []))
                                        <button class="btn btn-sm btn-secondary" disabled>@lang('agency.agents.invitation_sent')</button>
                                    @else
                                        <form action="{{ route('agency.agents.sendInvitation') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="agent_id" value="{{ $agentUser->agent->id }}">
                                            <button type="submit" class="btn btn-sm btn-success">@lang('agency.agents.send_invitation')</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        @if($query)
                            <tr><td colspan="3" class="text-center">@lang('agency.agents.no_agents_found_matching_search')</td></tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($agents->hasPages())
            <div class="card-footer">
                {{ $agents->appends(['query' => $query])->links('pagination::bootstrap-4') }}
            </div>
        @endif
    @endif
</div>
@endsection
