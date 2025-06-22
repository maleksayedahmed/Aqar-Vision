<div class="card-body">
    <div class="form-group">
        <label for="name">{{ __('attributes.roles.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role?->name) }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label>{{ __('attributes.roles.permissions') }}</label>
        <div class="row">
            @foreach ($permissions as $resource => $permissionGroup)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header text-capitalize">
                            <strong>{{ str_replace('-', ' ', $resource) }}</strong>
                        </div>
                        <div class="card-body">
                            @foreach ($permissionGroup as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                        {{-- 'list user' -> 'list' --}}
                                        {{ str_replace($resource, '', $permission->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>