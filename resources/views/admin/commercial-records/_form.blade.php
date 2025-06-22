<div class="card-body">
    <div class="form-group">
        <label for="agency_id">{{ __('attributes.commercial_records.agency_id') }}</label>
        <select class="form-control @error('agency_id') is-invalid @enderror" id="agency_id" name="agency_id" required>
            <option value="">{{ __('attributes.messages.select_user') }}</option>
            @foreach($agencies as $agency)
                <option value="{{ $agency->id }}" {{ old('agency_id', $commercialRecord?->agency_id) == $agency->id ? 'selected' : '' }}>{{ $agency->agency_name }}</option>
            @endforeach
        </select>
        @error('agency_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="commercial_register_number">{{ __('attributes.commercial_records.commercial_register_number') }}</label>
        <input type="text" class="form-control @error('commercial_register_number') is-invalid @enderror" id="commercial_register_number" name="commercial_register_number" value="{{ old('commercial_register_number', $commercialRecord?->commercial_register_number) }}" required>
        @error('commercial_register_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="commercial_issue_date">{{ __('attributes.commercial_records.commercial_issue_date') }}</label>
        <input type="date" class="form-control @error('commercial_issue_date') is-invalid @enderror" id="commercial_issue_date" name="commercial_issue_date" value="{{ old('commercial_issue_date', $commercialRecord?->commercial_issue_date?->format('Y-m-d')) }}">
        @error('commercial_issue_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="commercial_expiry_date">{{ __('attributes.commercial_records.commercial_expiry_date') }}</label>
        <input type="date" class="form-control @error('commercial_expiry_date') is-invalid @enderror" id="commercial_expiry_date" name="commercial_expiry_date" value="{{ old('commercial_expiry_date', $commercialRecord?->commercial_expiry_date?->format('Y-m-d')) }}">
        @error('commercial_expiry_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="city">{{ __('attributes.commercial_records.city') }}</label>
        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $commercialRecord?->city) }}">
        @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="address">{{ __('attributes.commercial_records.address') }}</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $commercialRecord?->address) }}">
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.commercial_records.save') }}</button>
    <a href="{{ route('admin.commercial-records.index') }}" class="btn btn-default">{{ __('attributes.commercial_records.cancel') }}</a>
</div> 