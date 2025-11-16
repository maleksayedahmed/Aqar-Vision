<div class="card-body">
    <div class="form-group">
        <label for="user_id">{{ __('attributes.subscriptions.user') }}</label>
        <select name="user_id" class="form-control" required>
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $subscription?->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="plan_id">{{ __('attributes.subscriptions.plan') }}</label>
        <select name="plan_id" class="form-control" required>
            <option value="">Select Plan</option>
            @foreach ($plans as $plan)
                <option value="{{ $plan->id }}" {{ old('plan_id', $subscription?->plan_id) == $plan->id ? 'selected' : '' }}>
                    {{ $plan->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date">{{ __('attributes.subscriptions.start_date') }}</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $subscription?->start_date?->format('Y-m-d')) }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date">{{ __('attributes.subscriptions.end_date') }}</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $subscription?->end_date?->format('Y-m-d')) }}" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="status">{{ __('attributes.subscriptions.status') }}</label>
        <select name="status" class="form-control" required>
            <option value="active" {{ old('status', $subscription?->status) == 'active' ? 'selected' : '' }}>{{ __('attributes.subscriptions.active') }}</option>
            <option value="expired" {{ old('status', $subscription?->status) == 'expired' ? 'selected' : '' }}>{{ __('attributes.subscriptions.expired') }}</option>
            <option value="cancelled" {{ old('status', $subscription?->status) == 'cancelled' ? 'selected' : '' }}>{{ __('attributes.subscriptions.cancelled') }}</option>
        </select>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.subscriptions.save_subscription') }}</button>
    <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-default">{{ __('attributes.subscriptions.cancel') }}</a>
</div>
