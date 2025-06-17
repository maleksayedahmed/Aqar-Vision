@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.agencies.create') }}</h3>
                    </div>
                    <form action="{{ route('admin.agencies.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">{{ __('attributes.agencies.user_id') }}</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                                    name="user_id" required>
                                    <option value="">{{ __('attributes.messages.select_user') }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="agency_name_en">{{ __('attributes.agencies.agency_name_en') }}</label>
                                <input type="text" class="form-control @error('agency_name.en') is-invalid @enderror"
                                    id="agency_name_en" name="agency_name[en]" value="{{ old('agency_name.en') }}"
                                    required>
                                @error('agency_name.en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="agency_name_ar">{{ __('attributes.agencies.agency_name_ar') }}</label>
                                <input type="text" class="form-control @error('agency_name.ar') is-invalid @enderror"
                                    id="agency_name_ar" name="agency_name[ar]" value="{{ old('agency_name.ar') }}"
                                    required>
                                @error('agency_name.ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="agency_type_id">{{ __('attributes.agencies.agency_type_id') }}</label>
                                <select class="form-control @error('agency_type_id') is-invalid @enderror"
                                    id="agency_type_id" name="agency_type_id" required>
                                    <option value="">{{ __('attributes.messages.select_agency_type') }}</option>
                                    @foreach ($agencyTypes as $agencyType)
                                        <option value="{{ $agencyType->id }}"
                                            {{ old('agency_type_id') == $agencyType->id ? 'selected' : '' }}>
                                            {{ $agencyType->getTranslation('name', app()->getLocale()) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agency_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    for="commercial_register_number">{{ __('attributes.agencies.commercial_register_number') }}</label>
                                <input type="text"
                                    class="form-control @error('commercial_register_number') is-invalid @enderror"
                                    id="commercial_register_number" name="commercial_register_number"
                                    value="{{ old('commercial_register_number') }}">
                                @error('commercial_register_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="commercial_issue_date">{{ __('attributes.agencies.commercial_issue_date') }}</label>
                                <input type="date"
                                    class="form-control @error('commercial_issue_date') is-invalid @enderror"
                                    id="commercial_issue_date" name="commercial_issue_date"
                                    value="{{ old('commercial_issue_date') }}">
                                @error('commercial_issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="commercial_expiry_date">{{ __('attributes.agencies.commercial_expiry_date') }}</label>
                                <input type="date"
                                    class="form-control @error('commercial_expiry_date') is-invalid @enderror"
                                    id="commercial_expiry_date" name="commercial_expiry_date"
                                    value="{{ old('commercial_expiry_date') }}">
                                @error('commercial_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tax_id">{{ __('attributes.agencies.tax_id') }}</label>
                                <input type="text" class="form-control @error('tax_id') is-invalid @enderror"
                                    id="tax_id" name="tax_id" value="{{ old('tax_id') }}">
                                @error('tax_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tax_issue_date">{{ __('attributes.agencies.tax_issue_date') }}</label>
                                <input type="date" class="form-control @error('tax_issue_date') is-invalid @enderror"
                                    id="tax_issue_date" name="tax_issue_date" value="{{ old('tax_issue_date') }}">
                                @error('tax_issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tax_expiry_date">{{ __('attributes.agencies.tax_expiry_date') }}</label>
                                <input type="date" class="form-control @error('tax_expiry_date') is-invalid @enderror"
                                    id="tax_expiry_date" name="tax_expiry_date" value="{{ old('tax_expiry_date') }}">
                                @error('tax_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address_en">{{ __('attributes.agencies.address_en') }}</label>
                                <textarea class="form-control @error('address.en') is-invalid @enderror" id="address_en" name="address[en]"
                                    rows="3">{{ old('address.en') }}</textarea>
                                @error('address.en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address_ar">{{ __('attributes.agencies.address_ar') }}</label>
                                <textarea class="form-control @error('address.ar') is-invalid @enderror" id="address_ar" name="address[ar]"
                                    rows="3">{{ old('address.ar') }}</textarea>
                                @error('address.ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone_number">{{ __('attributes.agencies.phone_number') }}</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('attributes.agencies.email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="accreditation_status_en">{{ __('attributes.agencies.accreditation_status_en') }}</label>
                                <input type="text"
                                    class="form-control @error('accreditation_status.en') is-invalid @enderror"
                                    id="accreditation_status_en" name="accreditation_status[en]"
                                    value="{{ old('accreditation_status.en') }}">
                                @error('accreditation_status.en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="accreditation_status_ar">{{ __('attributes.agencies.accreditation_status_ar') }}</label>
                                <input type="text"
                                    class="form-control @error('accreditation_status.ar') is-invalid @enderror"
                                    id="accreditation_status_ar" name="accreditation_status[ar]"
                                    value="{{ old('accreditation_status.ar') }}">
                                @error('accreditation_status.ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
                            <a href="{{ route('admin.agencies.index') }}"
                                class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
