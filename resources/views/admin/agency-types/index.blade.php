@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.agency_types.title') }}</h6>
                            <a href="{{ route('admin.agency-types.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.agency_types.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agency_types.name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.agency_types.description') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agency_types.status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.agency_types.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agencyTypes as $agencyType)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $agencyType->getTranslation('name', app()->getLocale()) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($agencyType->getTranslation('description', app()->getLocale()), 50) }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <form
                                                    action="{{ route('admin.agency-types.toggle-status', $agencyType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-sm mb-0 px-0">
                                                        <span
                                                            class="badge badge-sm {{ $agencyType->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                            {{ $agencyType->is_active ? __('attributes.agency_types.active') : __('attributes.agency_types.inactive') }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $agencyType->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.agency-types.edit', $agencyType->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="{{ __('attributes.agency_types.edit_agency_type_tooltip') }}">
                                                        {{ __('attributes.agency_types.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.agency-types.destroy', $agencyType->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="{{ __('attributes.agency_types.delete_agency_type_tooltip') }}">
                                                            {{ __('attributes.agency_types.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                {{ __('attributes.agency_types.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $agencyTypes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
