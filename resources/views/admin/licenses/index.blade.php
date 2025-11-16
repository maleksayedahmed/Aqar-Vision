@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.licenses.title') }}</h6>
                            <a href="{{ route('admin.licenses.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.licenses.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.licenses.license_number') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.licenses.license_type') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.licenses.issuer') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.licenses.expiry_date') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.licenses.status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.licenses.agency') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($licenses as $license)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $license->license_number }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $license->licenseType ? $license->licenseType->getTranslation('name', app()->getLocale()) : 'N/A' }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $license->issuer ?? 'N/A' }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $license->expiry_date ? $license->expiry_date->format('Y-m-d') : 'N/A' }}
                                                </span>
                                            </td>
                                            <td
                                                class="align-middle text-center text-sm
                                                @if ($license->is_expired) status-expired
                                                @elseif($license->days_until_expiry !== null && $license->days_until_expiry <= 30)
                                                    status-expiring-soon
                                                @else
                                                    status-active @endif
                                            ">
                                                @if ($license->is_expired)
                                                    <span class="badge badge-sm bg-gradient-danger">
                                                        {{ __('attributes.licenses.expired') }}
                                                    </span>
                                                @elseif($license->days_until_expiry !== null && $license->days_until_expiry <= 30)
                                                    <span class="badge badge-sm bg-gradient-warning">
                                                        {{ __('attributes.licenses.expiring_soon') }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        {{ __('attributes.licenses.active') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $license->agency ? $license->agency->getTranslation('agency_name', app()->getLocale()) : 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.licenses.show', $license->id) }}"
                                                        class="text-info font-weight-bold text-xs" data-toggle="tooltip"
                                                        data-original-title="{{ __('attributes.licenses.show') }}">
                                                        {{ __('attributes.licenses.show') }}
                                                    </a>
                                                    <a href="{{ route('admin.licenses.edit', $license->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="{{ __('attributes.licenses.edit') }}">
                                                        {{ __('attributes.licenses.edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.licenses.destroy', $license->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="{{ __('attributes.licenses.delete') }}">
                                                            {{ __('attributes.licenses.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                {{ __('attributes.licenses.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $licenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
