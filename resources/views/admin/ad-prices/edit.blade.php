@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Ad Price</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.ad-prices.update', $adPrice) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name_ar">Name (Arabic)</label>
                                <input type="text" class="form-control @error('name.ar') is-invalid @enderror"
                                    id="name_ar" name="name[ar]"
                                    value="{{ old('name.ar', $adPrice->getTranslation('name', 'ar')) }}" required>
                                @error('name.ar')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name_en">Name (English)</label>
                                <input type="text" class="form-control @error('name.en') is-invalid @enderror"
                                    id="name_en" name="name[en]"
                                    value="{{ old('name.en', $adPrice->getTranslation('name', 'en')) }}" required>
                                @error('name.en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                    value="{{ old('price', $adPrice->price) }}" required>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="duration_days">Duration (Days)</label>
                                <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                    id="duration_days" name="duration_days"
                                    value="{{ old('duration_days', $adPrice->duration_days) }}" required>
                                @error('duration_days')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control @error('type') is-invalid @enderror" id="type"
                                    name="type" required>
                                    <option value="regular"
                                        {{ old('type', $adPrice->type) == 'regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="featured"
                                        {{ old('type', $adPrice->type) == 'featured' ? 'selected' : '' }}>Featured</option>
                                    <option value="premium"
                                        {{ old('type', $adPrice->type) == 'premium' ? 'selected' : '' }}>Premium</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description_ar">Description (Arabic)</label>
                                <textarea class="form-control @error('description.ar') is-invalid @enderror" id="description_ar" name="description[ar]"
                                    rows="3">{{ old('description.ar', $adPrice->getTranslation('description', 'ar')) }}</textarea>
                                @error('description.ar')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description_en">Description (English)</label>
                                <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description[en]"
                                    rows="3">{{ old('description.en', $adPrice->getTranslation('description', 'en')) }}</textarea>
                                @error('description.en')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', $adPrice->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Active</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.ad-prices.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
