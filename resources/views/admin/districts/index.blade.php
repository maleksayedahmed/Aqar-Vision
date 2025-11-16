@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>@lang('attributes.districts.title')</h6>
                        <a href="{{ route('admin.districts.create') }}" class="btn btn-primary btn-sm">@lang('attributes.districts.create')</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('attributes.districts.district_name')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('attributes.districts.city')</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('attributes.districts.status')</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($districts as $district)
                                <tr>
                                    <td><p class="text-xs font-weight-bold mb-0 px-3">{{ $district->name }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $district->city->name }}</p></td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm {{ $district->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                            {{ $district->is_active ? @lang('attributes.districts.active') : @lang('attributes.districts.inactive') }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.districts.edit', $district) }}" class="text-secondary font-weight-bold text-xs">@lang('attributes.districts.edit')</a>
                                            <form action="{{ route('admin.districts.destroy', $district) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('@lang('attributes.districts.are_you_sure')')">@lang('attributes.districts.delete')</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4">@lang('attributes.districts.no_records')</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection