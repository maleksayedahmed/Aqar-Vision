<div class="card-body">
    <div class="form-group">
        <label for="name_en">{{ __('attributes.agency_types.name_en') }}</label>
        <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $agencyType?->getTranslation('name', 'en')) }}" required>
        @error('name.en')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name_ar">{{ __('attributes.agency_types.name_ar') }}</label>
        <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $agencyType?->getTranslation('name', 'ar')) }}" required>
        @error('name.ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description_en">{{ __('attributes.agency_types.description_en') }}</label>
        <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description[en]" rows="3">{{ old('description.en', $agencyType?->getTranslation('description', 'en')) }}</textarea>
        @error('description.en')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description_ar">{{ __('attributes.agency_types.description_ar') }}</label>
        <textarea class="form-control @error('description.ar') is-invalid @enderror" id="description_ar" name="description[ar]" rows="3">{{ old('description.ar', $agencyType?->getTranslation('description', 'ar')) }}</textarea>
        @error('description.ar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $agencyType?->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">{{ __('attributes.agency_types.is_active') }}</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.agency-types.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>