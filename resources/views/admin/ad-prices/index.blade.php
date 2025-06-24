@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.ad_prices.title') }}</h6>
                            <a href="{{ route('admin.ad-prices.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.ad_prices.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('attributes.ad_prices.name') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('attributes.ad_prices.type') }}</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('attributes.ad_prices.price') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('attributes.ad_prices.duration_days') }}</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('attributes.ad_prices.is_active') }}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prices as $price)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 px-3">{{ $price->getTranslation('name', app()->getLocale()) }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">{{ $price->type }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">${{ number_format($price->price, 2) }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $price->duration_days }} days</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{ $price->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ $price->is_active ? __('attributes.users.active') : __('attributes.users.inactive') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.ad-prices.edit', $price->id) }}" class="text-secondary font-weight-bold text-xs">{{ __('attributes.ad_prices.edit') }}</a>
                                                    <form action="{{ route('admin.ad-prices.destroy', $price->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent">{{ __('attributes.ad_prices.delete') }}</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">{{ __('attributes.ad_prices.no_records') }}</td>
                                        </tr>
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
