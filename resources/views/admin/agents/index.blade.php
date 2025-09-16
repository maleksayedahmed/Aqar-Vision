@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{{ __('attributes.agents.title') }}</h6>
                    <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-sm">
                        {{ __('attributes.agents.messages.create') }}
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('admin.agents.agent')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('admin.agents.contact')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('admin.agents.location')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('admin.agents.type')</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('admin.agents.status')</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents as $agent)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                {{-- You can add a profile picture here if you have one --}}
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $agent->full_name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $agent->user?->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $agent->phone_number }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $agent->city?->name ?? __('admin.agents.not_set') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $agent->agentType?->name }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if($agent->user?->is_active)
                                                <span class="badge badge-sm bg-gradient-success">@lang('admin.agents.messages.active')</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">@lang('admin.agents.messages.inactive')</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-right">
                                            <div class="d-flex justify-content-end gap-2 px-3">
                                                <a href="{{ route('admin.agents.edit', $agent->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="@lang('admin.agents.edit_agent_tooltip')">
                                                    @lang('admin.agents.messages.edit')
                                                </a>
                                                <form action="{{ route('admin.agents.destroy', $agent->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('{{ __('attributes.agents.messages.confirm_delete') }}')" data-toggle="tooltip" data-original-title="@lang('admin.agents.delete_agent_tooltip')">
                                                        @lang('admin.agents.messages.delete')
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            {{ __('attributes.agents.messages.no_records') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($agents->hasPages())
                    <div class="card-footer">
                        {{ $agents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection