<div class="card-body">
    <div class="form-group">
        <label for="name">{{ __('attributes.users.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user?->name) }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">{{ __('attributes.users.email') }}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user?->email) }}" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="role">{{ __('attributes.users.role') }}</label>
        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
            <option value="">{{ __('attributes.messages.select_role') }}</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ old('role', $user?->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">{{ __('attributes.users.password') }}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ !isset($user) ? 'required' : '' }} placeholder="{{ isset($user) ? __('attributes.messages.password_optional') : '' }}">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">{{ __('attributes.users.password_confirmation') }}</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" {{ !isset($user) ? 'required' : '' }}>
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $user?->is_active ?? true) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active">{{ __('attributes.users.is_active') }}</label>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>