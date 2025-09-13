{{-- This form handles creating the USER and the AGENT profile at the same time --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<h5 class="mb-3">User Account Details</h5>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name">{{__('attributes.agencies.email')}}</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $agent->user->name ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="email">@lang('attributes.agencies.email')</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $agent->user->email ?? '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $agent->user->phone ?? '') }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" {{ $agent->exists ? '' : 'required' }}>
        @if($agent->exists)<small class="form-text text-muted">Leave blank to keep current password.</small>@endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
</div>
<hr>
<h5 class="my-3">Agent Profile Details</h5>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="agent_type_id">Agent Type</label>
        <select name="agent_type_id" class="form-control" required>
            @foreach($agentTypes as $type)
                <option value="{{ $type->id }}" @selected(old('agent_type_id', $agent->agent_type_id) == $type->id)>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="city_id">City</label>
        <select name="city_id" class="form-control" required>
             @foreach($cities as $city)
                <option value="{{ $city->id }}" @selected(old('city_id', $agent->city_id) == $city->id)>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label for="license_number">License Number (FAL)</label>
        <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $agent->license_number) }}">
    </div>
</div>