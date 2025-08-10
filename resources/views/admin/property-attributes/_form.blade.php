<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">{{ __('attributes.property_attributes.name_en') }}</label>
                <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $propertyAttribute?->getTranslation('name', 'en')) }}" required>
                @error('name.en')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_ar">{{ __('attributes.property_attributes.name_ar') }}</label>
                <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $propertyAttribute?->getTranslation('name', 'ar')) }}" required>
                @error('name.ar')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="type">{{ __('attributes.property_attributes.type') }}</label>
                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required>
                    <option value="text" {{ old('type', $propertyAttribute?->type) == 'text' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.text') }}</option>
                    <option value="number" {{ old('type', $propertyAttribute?->type) == 'number' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.number') }}</option>
                    <option value="boolean" {{ old('type', $propertyAttribute?->type) == 'boolean' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.boolean') }}</option>
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon">Icon (Optional, preferably SVG/PNG)</label>
                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" id="icon">
                @error('icon')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
    </div>

    @if ($propertyAttribute?->icon_path)
        <div class="form-group mt-3">
            <label>Current Icon:</label>
            <div>
                <img src="{{ Storage::url($propertyAttribute->icon_path) }}" alt="Icon" style="width: 50px; height: 50px; background: #f0f0f0; padding: 5px; border-radius: 5px; object-fit: contain;">
            </div>
        </div>
    @endif
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.property-attributes.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>