<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">{{ __('attributes.property_types.name_en') }}</label>
                <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $propertyType?->getTranslation('name', 'en')) }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_ar">{{ __('attributes.property_types.name_ar') }}</label>
                <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $propertyType?->getTranslation('name', 'ar')) }}" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="parent_id">{{ __('attributes.property_types.parent_type') }}</label>
                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                    <option value="">— {{ __('attributes.messages.none') }} —</option>
                    @foreach ($parentTypes as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $propertyType?->parent_id) == $parent->id ? 'selected' : '' }}>
                            {{ $parent->getTranslation('name', app()->getLocale()) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon">{{ __('attributes.property_types.icon') }} (e.g., cil-building)</label>
                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $propertyType?->icon) }}">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="description_en">{{ __('attributes.property_types.description_en') }}</label>
        <textarea class="form-control @error('description.en') is-invalid @enderror" id="description_en" name="description[en]" rows="3">{{ old('description.en', $propertyType?->getTranslation('description', 'en')) }}</textarea>
    </div>

    <hr>

    <div class="form-group">
        <label>{{ __('attributes.property_types.applicable_attributes') }}</label>
        <div class="row">
            @forelse ($attributes as $attribute)
                <div class="col-md-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="attribute_{{ $attribute->id }}" name="attributes[]" value="{{ $attribute->id }}"
                            {{ in_array($attribute->id, old('attributes', $selectedAttributes ?? [])) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="attribute_{{ $attribute->id }}">
                            {{ $attribute->getTranslation('name', app()->getLocale()) }}
                        </label>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">{{ __('attributes.messages.no_attributes_defined') }}</p>
                    <a href="#">{{ __('attributes.messages.create_attribute_first') }}</a>
                </div>
            @endforelse
        </div>
    </div>
    
    <hr>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $propertyType?->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">{{ __('attributes.property_types.is_active') }}</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.property-types.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>