@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.property_attributes.title') }}</h6>
                            <a href="{{ route('admin.property-attributes.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.property_attributes.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('attributes.property_attributes.name') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('attributes.property_attributes.type') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('attributes.property_attributes.created_at') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($attributes as $attribute)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 px-3">{{ $attribute->getTranslation('name', app()->getLocale()) }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">{{ $attribute->type }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $attribute->created_at->format('Y-m-d') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.property-attributes.edit', $attribute->id) }}" class="text-secondary font-weight-bold text-xs">{{ __('attributes.property_attributes.edit') }}</a>
                                                    <form action="{{ route('admin.property-attributes.destroy', $attribute->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent">{{ __('attributes.property_attributes.delete') }}</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">{{ __('attributes.property_attributes.no_records') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($attributes->hasPages())
                        <div class="card-footer">
                            {{ $attributes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection