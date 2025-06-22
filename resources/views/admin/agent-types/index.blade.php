@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.agents.agent_type_title') }}</h6>
                            <a href="{{ route('admin.agent-types.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.agents.messages.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agents.agent_type_name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.agent_type_description') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.agent_type_is_active') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agentTypes as $agentType)
                                        <tr>
                                            <td>{{ $agentType->name }}</td>
                                            <td>{{ $agentType->description }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $agentType->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ $agentType->is_active ? __('attributes.agents.messages.active') : __('attributes.agents.messages.inactive') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.agent-types.edit', $agentType->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit agent type">
                                                        {{ __('attributes.agents.messages.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.agent-types.destroy', $agentType->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            onclick="return confirm('{{ __('attributes.agents.messages.confirm_delete') }}')"
                                                            data-toggle="tooltip" data-original-title="Delete agent type">
                                                            {{ __('attributes.agents.messages.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                {{ __('attributes.agents.messages.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($agentTypes->hasPages())
                        <div class="card-footer">
                            {{ $agentTypes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
