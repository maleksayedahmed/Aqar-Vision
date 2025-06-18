@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ __('attributes.licenses.license_details') }}</h3>
                            <div>
                                <a href="{{ route('admin.licenses.edit', $license->id) }}" class="btn btn-primary btn-sm">
                                    {{ __('attributes.licenses.edit') }}
                                </a>
                                <a href="{{ route('admin.licenses.index') }}" class="btn btn-default btn-sm">
                                    {{ __('attributes.messages.cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('attributes.licenses.license_information') }}</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.license_number') }}:</td>
                                        <td>{{ $license->license_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.license_type') }}:</td>
                                        <td>{{ $license->licenseType ? $license->licenseType->getTranslation('name', app()->getLocale()) : 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.issuer') }}:</td>
                                        <td>{{ $license->issuer ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.issue_date') }}:</td>
                                        <td>{{ $license->issue_date ? $license->issue_date->format('Y-m-d') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.expiry_date') }}:</td>
                                        <td>
                                            {{ $license->expiry_date ? $license->expiry_date->format('Y-m-d') : 'N/A' }}
                                            @if ($license->days_until_expiry !== null)
                                                <span
                                                    class="badge badge-sm {{ $license->is_expired ? 'bg-gradient-danger' : ($license->days_until_expiry <= 30 ? 'bg-gradient-warning' : 'bg-gradient-success') }}">
                                                    @if ($license->is_expired)
                                                        {{ __('attributes.licenses.expired') }}
                                                    @elseif($license->days_until_expiry <= 30)
                                                        {{ __('attributes.licenses.expiring_soon') }}
                                                    @else
                                                        {{ __('attributes.licenses.active') }}
                                                    @endif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($license->days_until_expiry !== null && !$license->is_expired)
                                        <tr>
                                            <td class="font-weight-bold">{{ __('attributes.licenses.days_until_expiry') }}:
                                            </td>
                                            <td>{{ $license->days_until_expiry }} {{ __('attributes.messages.date') }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ __('attributes.licenses.related_entities') }}</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.agency') }}:</td>
                                        <td>{{ $license->agency ? $license->agency->getTranslation('agency_name', app()->getLocale()) : 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.agent') }}:</td>
                                        <td>{{ $license->agent ? $license->agent->full_name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.created_at') }}:</td>
                                        <td>{{ $license->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">{{ __('attributes.licenses.status') }}:</td>
                                        <td>
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
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
