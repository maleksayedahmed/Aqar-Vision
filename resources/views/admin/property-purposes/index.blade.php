@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.property_purposes.title') }}</h6>
                            <a href="{{ route('admin.property-purposes.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.property_purposes.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_purposes.name') }}</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            {{ __('attributes.property_purposes.description') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_purposes.status') }}</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ __('attributes.property_purposes.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($propertyPurposes as $propertyPurpose)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ $propertyPurpose->getTranslation('name', app()->getLocale()) }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ Str::limit($propertyPurpose->getTranslation('description', app()->getLocale()), 50) }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <form
                                                    action="{{ route('admin.property-purposes.toggle-status', $propertyPurpose->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-sm mb-0 px-0">
                                                        <span
                                                            class="badge badge-sm {{ $propertyPurpose->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                            {{ $propertyPurpose->is_active ? __('attributes.property_purposes.active') : __('attributes.property_purposes.inactive') }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $propertyPurpose->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.property-purposes.edit', $propertyPurpose->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit property purpose">
                                                        {{ __('attributes.property_purposes.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.property-purposes.destroy', $propertyPurpose->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip"
                                                            data-original-title="Delete property purpose">
                                                            {{ __('attributes.property_purposes.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                {{ __('attributes.property_purposes.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $propertyPurposes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
