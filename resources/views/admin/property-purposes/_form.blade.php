<div class="card-body">
    <div class="form-group">
        <label for="name_en">{{ __('attributes.property_purposes.name_en') }}</label>
        <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $propertyPurpose?->getTranslation('name', 'en')) }}" required>
        @error('name.en')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name_ar">{{ __('attributes.property_purposes.name_ar') }}</label>
        <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $propertyPurpose?->getTranslation('name', 'ar')) }}" required>
        @error('name.ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description_en">{{ __('attributes.property_purposes.description_en') }}</label>
        <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description[en]" rows="3">{{ old('description.en', $propertyPurpose?->getTranslation('description', 'en')) }}</textarea>
        @error('description.en')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description_ar">{{ __('attributes.property_purposes.description_ar') }}</label>
        <textarea class="form-control @error('description.ar') is-invalid @enderror" id="description_ar" name="description[ar]" rows="3">{{ old('description.ar', $propertyPurpose?->getTranslation('description', 'ar')) }}</textarea>
        @error('description.ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $propertyPurpose?->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">{{ __('attributes.property_purposes.is_active') }}</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.property-purposes.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>