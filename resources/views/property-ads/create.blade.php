@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Property Ad</h3>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('property-ads.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="property_id">Select Property</label>
                            <select class="form-control @error('property_id') is-invalid @enderror" 
                                id="property_id" name="property_id" required>
                                <option value="">Select a property</option>
                                @foreach($properties as $property)
                                    <option value="{{ $property->id }}" 
                                        {{ request('property_id') == $property->id ? 'selected' : '' }}>
                                        {{ $property->title }} - {{ number_format($property->total_price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('property_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Select Ad Type</label>
                            <div class="row">
                                @foreach($adPrices as $price)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $price->getTranslation('name', app()->getLocale()) }}</h5>
                                                <p class="card-text">{{ $price->getTranslation('description', app()->getLocale()) }}</p>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" 
                                                        id="ad_price_{{ $price->id }}" 
                                                        name="ad_price_id" 
                                                        value="{{ $price->id }}"
                                                        {{ old('ad_price_id') == $price->id ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="ad_price_{{ $price->id }}">
                                                        {{ number_format($price->price, 2) }} - {{ $price->duration_days }} days
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('ad_price_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Ad</button>
                            <a href="{{ route('property-ads.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 