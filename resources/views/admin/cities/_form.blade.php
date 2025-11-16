<div class="card-body">
    <div class="form-group">
        <label for="name">@lang('admin.cities.city_name')</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $city->name ?? '') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $city->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">@lang('admin.cities.active')</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">@lang('admin.cities.save')</button>
    <a href="{{ route('admin.cities.index') }}" class="btn btn-default">@lang('admin.cities.cancel')</a>
</div>