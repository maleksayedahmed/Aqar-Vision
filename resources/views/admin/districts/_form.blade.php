<div class="card-body">
    <div class="form-group">
        <label for="city_id">City</label>
        <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required>
            <option value="">-- Select City --</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id', $district->city_id ?? '') == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
        @error('city_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">District Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $district->name ?? '') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $district->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">Active</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.districts.index') }}" class="btn btn-default">Cancel</a>
</div>