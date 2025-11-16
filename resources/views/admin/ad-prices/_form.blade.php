<div class="card-body">
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="name_en">@lang('admin.name_en')</label>
            <input type="text" id="name_en" name="name[en]" class="form-control @error('name.en') is-invalid @enderror" value="{{ old('name.en', $adPrice->getTranslation('name', 'en')) }}" required>
            @error('name.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="name_ar">@lang('admin.name_ar')</label>
            <input type="text" id="name_ar" name="name[ar]" class="form-control @error('name.ar') is-invalid @enderror" value="{{ old('name.ar', $adPrice->getTranslation('name', 'ar')) }}" required>
            @error('name.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="icon_path">@lang('admin.icon_path_ad_price')</label>
        
        {{-- Show current icon if it exists --}}
        @if ($adPrice->icon_path)
            <div class="my-2">
                <img src="{{ Storage::url($adPrice->icon_path) }}" alt="Current Icon" class="img-thumbnail" style="max-height: 60px;">
                <p class="form-text text-muted mt-1">@lang('admin.current_icon_ad_price')</p>
            </div>
        @endif
        
        {{-- The file input field --}}
        <input type="file" id="icon_path" name="icon_path" class="form-control-file @error('icon_path') is-invalid @enderror">
        @error('icon_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Rest of the form fields... --}}
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="price">@lang('admin.price')</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $adPrice->price) }}" required>
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="duration_days">@lang('admin.duration_days')</label>
            <input type="number" id="duration_days" name="duration_days" class="form-control @error('duration_days') is-invalid @enderror" value="{{ old('duration_days', $adPrice->duration_days) }}" required>
            @error('duration_days') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="type">@lang('admin.type')</label>
        <input type="text" id="type" name="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $adPrice->type) }}" required>
        <small class="form-text text-muted">@lang('admin.type_help_text')</small>
        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label for="description_en">@lang('admin.description_en')</label>
            <textarea id="description_en" name="description[en]" class="form-control @error('description.en') is-invalid @enderror" rows="3">{{ old('description.en', $adPrice->getTranslation('description', 'en')) }}</textarea>
            @error('description.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-6 form-group">
            <label for="description_ar">@lang('admin.description_ar')</label>
            <textarea id="description_ar" name="description[ar]" class="form-control @error('description.ar') is-invalid @enderror" rows="3">{{ old('description.ar', $adPrice->getTranslation('description', 'ar')) }}</textarea>
            @error('description.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" @if(old('is_active', $adPrice->is_active)) checked @endif>
            <label class="form-check-label" for="is_active">@lang('admin.is_active')</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
    <a href="{{ route('admin.ad-prices.index') }}" class="btn btn-secondary">@lang('admin.cancel')</a>
</div>