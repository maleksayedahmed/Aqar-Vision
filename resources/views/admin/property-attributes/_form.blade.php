<div class="card-body">
    <div class="form-group">
        <label for="name_en">{{ __('attributes.property_attributes.name_en') }}</label>
        <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $propertyAttribute?->getTranslation('name', 'en')) }}" required>
        @error('name.en')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name_ar">{{ __('attributes.property_attributes.name_ar') }}</label>
        <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $propertyAttribute?->getTranslation('name', 'ar')) }}" required>
        @error('name.ar')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
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
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.property-attributes.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>