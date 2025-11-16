@extends('agency.layouts.app')

@section('agency-content')
    <div class="container-fluid py-4">
        {{-- KPI Widgets --}}
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('agency.dashboard.total_ads')</p>
                                    <h5 class="font-weight-bolder">{{ $adsCount ?? 0 }}</h5>
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{ $newAdsLast7Days ?? 0 }}</span> @lang('agency.dashboard.new_ads_last_7_days')</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fas fa-ad text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">@lang('agency.dashboard.total_agents')</p>
                                    <h5 class="font-weight-bolder">{{ $agentsCount ?? 0 }}</h5>
                                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">&nbsp;</span> @lang('agency.dashboard.active')</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-users text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Latest items --}}
        <div class="row mt-4">
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">@lang('agency.dashboard.latest_ads')</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @forelse($latestAds as $ad)
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{ !empty($ad->images) && is_array($ad->images) && !empty($ad->images[0]) ? Storage::url($ad->images[0]) : 'https://via.placeholder.com/100' }}" alt="img" width="40">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">@lang('agency.dashboard.title')</p>
                                                <h6 class="text-sm mb-0">{{ Str::limit($ad->title, 30) }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">@lang('agency.dashboard.price')</p>
                                            <h6 class="text-sm mb-0">${{ number_format($ad->total_price) }}</h6>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center py-3">@lang('agency.dashboard.no_ads_found')</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">@lang('agency.dashboard.latest_agents')</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @forelse($latestAgents as $agent)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="fas fa-user text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ $agent->full_name }}</h6>
                                        <span class="text-xs">{{ $agent->phone_number ?? $agent->email }}</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('agency.agents.edit', $agent->id) }}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item border-0 text-center">@lang('agency.dashboard.no_agents_found')</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
