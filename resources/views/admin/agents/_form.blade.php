<div class="card-body">
    <h5 class="mb-3">Basic Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_id">{{ __('attributes.agents.user_id') }}</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">{{ __('attributes.agents.messages.select_user') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $agent?->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="full_name">{{ __('attributes.agents.full_name') }}</label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $agent?->full_name) }}" required>
                @error('full_name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ __('attributes.agents.email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $agent?->email) }}">
                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone_number">{{ __('attributes.agents.phone_number') }}</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $agent?->phone_number) }}">
                @error('phone_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>

    <hr>
    <h5 class="mt-4">Professional Details</h5>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="agent_type_id">{{ __('attributes.agents.agent_type_id') }}</label>
                <select class="form-control @error('agent_type_id') is-invalid @enderror" id="agent_type_id" name="agent_type_id" required>
                    <option value="">Select a type</option>
                    @foreach ($agentTypes as $agentType)
                        <option value="{{ $agentType->id }}" {{ old('agent_type_id', $agent?->agent_type_id) == $agentType->id ? 'selected' : '' }}>{{ $agentType->getTranslation('name', app()->getLocale()) }}</option>
                    @endforeach
                </select>
                @error('agent_type_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="agency_id">{{ __('attributes.agents.agency_id') }} (Optional)</label>
                <select class="form-control @error('agency_id') is-invalid @enderror" id="agency_id" name="agency_id">
                    <option value="">{{ __('attributes.agents.messages.select_agency') }}</option>
                    @foreach ($agencies as $agency)
                        <option value="{{ $agency->id }}" {{ old('agency_id', $agent?->agency_id) == $agency->id ? 'selected' : '' }}>{{ $agency->getTranslation('agency_name', app()->getLocale()) }}</option>
                    @endforeach
                </select>
                @error('agency_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city_id">City</label>
                <select class="form-control @error('city_id') is-invalid @enderror" id="city_id" name="city_id">
                    <option value="">Select City</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $agent?->city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @error('city_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>

    <hr>
    <h5 class="mt-4">Identification & Licensing</h5>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="national_id">{{ __('attributes.agents.national_id') }}</label>
                <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="national_id" name="national_id" value="{{ old('national_id', $agent?->national_id) }}">
                @error('national_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="license_number">{{ __('attributes.agents.license_number') }}</label>
                <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number', $agent?->license_number) }}">
                @error('license_number')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="license_issue_date">{{ __('attributes.agents.license_issue_date') }}</label>
                <input type="date" class="form-control @error('license_issue_date') is-invalid @enderror" id="license_issue_date" name="license_issue_date" value="{{ old('license_issue_date', $agent?->license_issue_date?->format('Y-m-d')) }}">
                @error('license_issue_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="license_expiry_date">{{ __('attributes.agents.license_expiry_date') }}</label>
                <input type="date" class="form-control @error('license_expiry_date') is-invalid @enderror" id="license_expiry_date" name="license_expiry_date" value="{{ old('license_expiry_date', $agent?->license_expiry_date?->format('Y-m-d')) }}">
                @error('license_expiry_date')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>

    <div class="form-group mt-3">
        <label for="address">{{ __('attributes.agents.address') }}</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $agent?->address) }}">
        @error('address')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.agents.messages.save') }}</button>
    <a href="{{ route('admin.agents.index') }}" class="btn btn-default">{{ __('attributes.agents.messages.cancel') }}</a>
</div>