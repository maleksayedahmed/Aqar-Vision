@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        {{-- KPI Widgets --}}
        <div class="row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Revenue This Month</p>
                                    <h5 class="font-weight-bolder">
                                        ${{ number_format($totalRevenueThisMonth ?? 0, 2) }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">{{ $propertiesCount ?? 0 }}</span>
                                        Total Properties
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-dollar-sign text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Users (Last 7 Days)</p>
                                    <h5 class="font-weight-bolder">
                                        +{{ $newUsersLast7Days ?? 0 }}
                                    </h5>
                                     <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">{{ $usersCount ?? 0 }}</span>
                                        Total Users
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="fas fa-user-plus text-lg opacity-10"></i>
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
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Properties (Last 7 Days)</p>
                                    <h5 class="font-weight-bolder">
                                        +{{ $newPropertiesLast7Days ?? 0 }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">{{ $agenciesCount ?? 0 }}</span>
                                        Total Agencies
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="fas fa-home text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Summary Tables --}}
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Latest Properties</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @forelse($latestProperties as $property)
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{ $property->getFirstMediaUrl('property_images', 'thumb') ?: 'https://via.placeholder.com/100' }}" alt="img" width="40">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Title:</p>
                                                <h6 class="text-sm mb-0">{{ Str::limit($property->title, 25) }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Price:</p>
                                            <h6 class="text-sm mb-0">${{ number_format($property->total_price) }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Type:</p>
                                            <h6 class="text-sm mb-0">{{ $property->propertyType?->name }}</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Status:</p>
                                            <span class="badge badge-sm bg-gradient-success">{{ $property->status }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">No properties found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Latest Users</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @forelse($latestUsers as $user)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="fas fa-user text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{ $user->name }}</h6>
                                        <span class="text-xs">{{ $user->email }} - <span class="font-weight-bold">{{ $user->created_at->diffForHumans() }}</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right" aria-hidden="true"></i></a>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item border-0 text-center">No new users.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
