<div class="card-body">
    <div class="form-group">
        <label for="name">Country Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $country->name ?? '') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="code">Country Code (e.g., SA)</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $country->code ?? '') }}">
        @error('code')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $country->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">Active</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-default">Cancel</a>
</div>