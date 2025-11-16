@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.property_types.title') }}</h6>
                            <a href="{{ route('admin.property-types.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.property_types.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_types.name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.property_types.description') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_types.status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_types.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($propertyTypes as $propertyType)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $propertyType->getTranslation('name', app()->getLocale()) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($propertyType->getTranslation('description', app()->getLocale()), 50) }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <form
                                                    action="{{ route('admin.property-types.toggle-status', $propertyType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-sm mb-0 px-0">
                                                        <span
                                                            class="badge badge-sm {{ $propertyType->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                            {{ $propertyType->is_active ? __('attributes.property_types.active') : __('attributes.property_types.inactive') }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $propertyType->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.property-types.edit', $propertyType->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="{{ __('attributes.property_types.edit_property_type_tooltip') }}">
                                                        {{ __('attributes.property_types.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.property-types.destroy', $propertyType->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="{{ __('attributes.property_types.delete_property_type_tooltip') }}">
                                                            {{ __('attributes.property_types.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                {{ __('attributes.property_types.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($propertyTypes->hasPages())
                        <div class="card-footer">
                            {{ $propertyTypes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection