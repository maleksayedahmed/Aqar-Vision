@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                {{-- Filter Card --}}
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>@lang('admin.common.filters')</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.properties.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="@lang('admin.common.search_by_title')" value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="city" class="form-control" placeholder="@lang('admin.common.search_by_city')" value="{{ request('city') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="">@lang('admin.common.all_statuses')</option>
                                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>@lang('admin.common.available')</option>
                                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>@lang('admin.common.sold')</option>
                                            <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>@lang('admin.common.rented')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="property_type_id" class="form-control">
                                            <option value="">@lang('admin.common.all_types')</option>
                                            @foreach($propertyTypes as $type)
                                                <option value="{{ $type->id }}" {{ request('property_type_id') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->getTranslation('name', app()->getLocale()) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">@lang('admin.common.filter')</button>
                                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">@lang('admin.common.reset')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Properties Table Card --}}
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Properties</h6>
                        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">Create Property</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($properties as $property)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 px-3">{{ $property->title }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ optional($property->propertyType)->getTranslation('name', app()->getLocale()) }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm 
                                                    @if($property->status == 'available') bg-gradient-success
                                                    @elseif($property->status == 'sold') bg-gradient-danger
                                                    @else bg-gradient-info @endif">
                                                    {{ ucfirst($property->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ optional($property->user)->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2 px-3">
                                                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="{{ __('attributes.properties.edit_property_tooltip') }}">{{ __('attributes.properties.edit') }}</a>
                                                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('attributes.properties.are_you_sure') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" data-toggle="tooltip" title="{{ __('attributes.properties.delete_property_tooltip') }}">{{ __('attributes.properties.delete') }}</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center py-4">{{ __('attributes.properties.no_records') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($properties->hasPages())
                        <div class="card-footer d-flex justify-content-center">
                            {{-- This line uses Bootstrap 4 styling and keeps the filter parameters in the links --}}
                            {{ $properties->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection