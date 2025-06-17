@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Property Ads</h3>
                        <div class="card-tools">
                            <a href="{{ route('property-ads.create') }}" class="btn btn-primary btn-sm">
                                Create New Ad
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @forelse($properties as $property)
                            <div class="property-card mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $property->title }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><strong>Description:</strong> {{ $property->description }}</p>
                                                <p><strong>Price:</strong> {{ number_format($property->total_price, 2) }}
                                                </p>
                                                <p><strong>Location:</strong> {{ $property->city }},
                                                    {{ $property->neighborhood }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Active Ads</h5>
                                                @forelse($property->advertisements->where('status', 'active') as $ad)
                                                    <div class="ad-info mb-2">
                                                        <p><strong>Type:</strong> {{ ucfirst($ad->type) }}</p>
                                                        <p><strong>Start Date:</strong>
                                                            {{ $ad->start_date->format('Y-m-d') }}</p>
                                                        <p><strong>End Date:</strong> {{ $ad->end_date->format('Y-m-d') }}
                                                        </p>
                                                        <form action="{{ route('property-ads.cancel', $ad) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to cancel this ad?')">
                                                                Cancel Ad
                                                            </button>
                                                        </form>
                                                    </div>
                                                @empty
                                                    <p>No active ads for this property.</p>
                                                    <a href="{{ route('property-ads.create') }}?property_id={{ $property->id }}"
                                                        class="btn btn-primary btn-sm">
                                                        Create Ad
                                                    </a>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                You don't have any properties yet. Please add a property first.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
