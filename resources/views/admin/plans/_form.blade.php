<div class="card-body">
    <div class="form-group">
        <label for="name_en">{{ __('attributes.plans.name_en') }}</label>
        <input type="text" class="form-control" name="name[en]" value="{{ old('name.en', $plan?->getTranslation('name', 'en')) }}" required>
    </div>
    <div class="form-group">
        <label for="name_ar">{{ __('attributes.plans.name_ar') }}</label>
        <input type="text" class="form-control" name="name[ar]" value="{{ old('name.ar', $plan?->getTranslation('name', 'ar')) }}" required>
    </div>
    <div class="form-group">
        <label for="target_type">{{ __('attributes.plans.target_type') }}</label>
        <select name="target_type" class="form-control" required>
            <option value="agent" {{ old('target_type', $plan?->target_type) == 'agent' ? 'selected' : '' }}>Agent</option>
            <option value="agency" {{ old('target_type', $plan?->target_type) == 'agency' ? 'selected' : '' }}>Agency</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price_monthly">{{ __('attributes.plans.price_monthly') }}</label>
        <input type="number" step="0.01" class="form-control" name="price_monthly" value="{{ old('price_monthly', $plan?->price_monthly) }}" required>
    </div>
    <div class="form-group">
        <label for="ads_regular">{{ __('attributes.plans.ads_regular') }}</label>
        <input type="number" class="form-control" name="ads_regular" value="{{ old('ads_regular', $plan?->ads_regular) }}" required>
    </div>
    <div class="form-group">
        <label for="ads_featured">{{ __('attributes.plans.ads_featured') }}</label>
        <input type="number" class="form-control" name="ads_featured" value="{{ old('ads_featured', $plan?->ads_featured) }}" required>
    </div>
    <div class="form-group">
        <label for="ads_premium">{{ __('attributes.plans.ads_premium') }}</label>
        <input type="number" class="form-control" name="ads_premium" value="{{ old('ads_premium', $plan?->ads_premium) }}" required>
    </div>
    <div class="form-group">
        <label for="ads_map">{{ __('attributes.plans.ads_map') }}</label>
        <input type="number" class="form-control" name="ads_map" value="{{ old('ads_map', $plan?->ads_map) }}" required>
    </div>
    <div class="form-group">
        <label for="agent_seats">{{ __('attributes.plans.agent_seats') }}</label>
        <input type="number" class="form-control" name="agent_seats" value="{{ old('agent_seats', $plan?->agent_seats) }}">
    </div>
    <div class="form-group">
        <label for="description_en">{{ __('attributes.plans.description_en') }}</label>
        <textarea name="description[en]" class="form-control">{{ old('description.en', $plan?->getTranslation('description', 'en')) }}</textarea>
    </div>
    <div class="form-group">
        <label for="description_ar">{{ __('attributes.plans.description_ar') }}</label>
        <textarea name="description[ar]" class="form-control">{{ old('description.ar', $plan?->getTranslation('description', 'ar')) }}</textarea>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.plans.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>
