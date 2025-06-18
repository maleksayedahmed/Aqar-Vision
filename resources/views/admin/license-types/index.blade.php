@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.license_types.title') }}</h6>
                            <a href="{{ route('admin.license-types.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.license_types.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.license_types.name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.license_types.description') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.license_types.status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.license_types.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($licenseTypes as $licenseType)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $licenseType->getTranslation('name', app()->getLocale()) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($licenseType->getTranslation('description', app()->getLocale()), 50) }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <form
                                                    action="{{ route('admin.license-types.toggle-status', $licenseType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-sm mb-0 px-0">
                                                        <span
                                                            class="badge badge-sm {{ $licenseType->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                            {{ $licenseType->is_active ? __('attributes.license_types.active') : __('attributes.license_types.inactive') }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $licenseType->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.license-types.edit', $licenseType->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit license type">
                                                        {{ __('attributes.license_types.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.license-types.destroy', $licenseType->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="Delete license type">
                                                            {{ __('attributes.license_types.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                {{ __('attributes.license_types.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $licenseTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
