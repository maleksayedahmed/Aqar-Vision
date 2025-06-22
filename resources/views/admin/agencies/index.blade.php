@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.agencies.title') }}</h6>
                            <a href="{{ route('admin.agencies.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.agencies.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agencies.agency_name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agencies.agency_type') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agencies.commercial_register') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agencies.phone') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agencies.accreditation_status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agencies.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agencies as $agency)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $agency->getTranslation('agency_name', app()->getLocale()) }}
                                                        </h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $agency->user->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $agency->agencyType->getTranslation('name', app()->getLocale()) }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $agency->commercial_register_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $agency->phone_number }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <form
                                                    action="{{ route('admin.agencies.update-accreditation-status', $agency->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-sm mb-0 px-0">
                                                        <span
                                                            class="badge badge-sm {{ $agency->getTranslation('accreditation_status', 'en') === 'Accredited' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                            {{ $agency->getTranslation('accreditation_status', app()->getLocale()) }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $agency->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.agencies.edit', $agency->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit agency">
                                                        {{ __('attributes.agencies.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.agencies.destroy', $agency->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="Delete agency">
                                                            {{ __('attributes.agencies.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                {{ __('attributes.agencies.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($agencies->hasPages())
                        <div class="card-footer">
                            {{ $agencies->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection