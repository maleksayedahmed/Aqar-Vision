@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">@lang('admin.ad_packages')</h3>
            <a href="{{ route('admin.ad-prices.create') }}" class="btn btn-primary btn-sm">@lang('admin.create_new')</a>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>@lang('admin.icon')</th>
                        <th>@lang('admin.name')</th>
                        <th>@lang('admin.type')</th>
                        <th>@lang('admin.price')</th>
                        <th>@lang('admin.duration')</th>
                        <th>@lang('admin.status')</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prices as $price)
                        <tr>
                            <td>
                                @if($price->icon_path)
                                    {{-- Use Storage::url() to get the correct public path --}}
                                    <img src="{{ Storage::url($price->icon_path) }}" alt="icon" class="avatar">
                                @else
                                    <span class="avatar" style="background-color: #eee"></span>
                                @endif
                            </td>
                            <td>{{ $price->name }}</td>
                            <td><span class="badge bg-secondary">{{ $price->type }}</span></td>
                            <td>{{ $price->price }} SAR</td>
                            <td>{{ $price->duration_days }} days</td>
                            <td>
                                @if($price->is_active)
                                    <span class="badge bg-success">@lang('admin.active')</span>
                                @else
                                    <span class="badge bg-danger">@lang('admin.inactive')</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('admin.ad-prices.edit', $price) }}" class="btn btn-sm btn-primary">@lang('admin.edit')</a>
                                    <form action="{{ route('admin.ad-prices.destroy', $price) }}" method="POST" onsubmit="return confirm('@lang('admin.delete_confirmation')');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">@lang('admin.delete')</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">@lang('admin.no_ad_packages_found')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $prices->links() }}
        </div>
    </div>
@endsection