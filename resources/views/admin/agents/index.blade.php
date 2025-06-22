@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.agents.title') }}</h6>
                            <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-sm">
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
                                            {{ __('attributes.agents.full_name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.user_id') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.agent_type_id') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.agency_id') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.phone_number') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.email') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.license_number') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.license_issue_date') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.license_expiry_date') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.national_id') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agents.address') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agents as $agent)
                                        <tr>
                                            <td>{{ $agent->full_name }}</td>
                                            <td>{{ $agent->user?->name }}</td>
                                            <td>{{ $agent->agentType?->getTranslation('name', app()->getLocale()) }}</td>
                                            <td>{{ $agent->agency?->getTranslation('agency_name', app()->getLocale()) }}
                                            </td>
                                            <td>{{ $agent->phone_number }}</td>
                                            <td>{{ $agent->email }}</td>
                                            <td>{{ $agent->license_number }}</td>
                                            <td>{{ $agent->license_issue_date }}</td>
                                            <td>{{ $agent->license_expiry_date }}</td>
                                            <td>{{ $agent->national_id }}</td>
                                            <td>{{ $agent->address }}</td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.agents.edit', $agent->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit agent">
                                                        {{ __('attributes.agents.messages.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.agents.destroy', $agent->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            onclick="return confirm('{{ __('attributes.agents.messages.confirm_delete') }}')"
                                                            data-toggle="tooltip" data-original-title="Delete agent">
                                                            {{ __('attributes.agents.messages.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center py-4">
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
