@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ad Details</h3>
                </div>

                <div class="card-body">
                    <div class="property-details mb-4">
                        <h4>Property Information</h4>
                        <p><strong>Title:</strong> {{ $advertisement->property->title }}</p>
                        <p><strong>Description:</strong> {{ $advertisement->property->description }}</p>
                        <p><strong>Price:</strong> {{ number_format($advertisement->property->total_price, 2) }}</p>
                        <p><strong>Location:</strong> {{ $advertisement->property->city }}, {{ $advertisement->property->neighborhood }}</p>
                    </div>

                    <div class="ad-details">
                        <h4>Ad Information</h4>
                        <p><strong>Status:</strong> 
                            <span class="badge badge-{{ $advertisement->status === 'active' ? 'success' : ($advertisement->status === 'expired' ? 'warning' : 'danger') }}">
                                {{ ucfirst($advertisement->status) }}
                            </span>
                        </p>
                        <p><strong>Start Date:</strong> {{ $advertisement->start_date->format('Y-m-d') }}</p>
                        <p><strong>End Date:</strong> {{ $advertisement->end_date->format('Y-m-d') }}</p>
                        <p><strong>Days Remaining:</strong> {{ max(0, now()->diffInDays($advertisement->end_date, false)) }}</p>
                    </div>

                    @if($advertisement->status === 'active')
                        <div class="mt-4">
                            <form action="{{ route('property-ads.cancel', $advertisement) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this ad?')">
                                    Cancel Ad
                                </button>
                            </form>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('property-ads.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 