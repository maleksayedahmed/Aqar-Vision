@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">{{ __('attributes.subscriptions.title') }}</h3>
            <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary btn-sm">{{ __('attributes.subscriptions.create') }}</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('attributes.subscriptions.user') }}</th>
                        <th>{{ __('attributes.subscriptions.plan') }}</th>
                        <th>{{ __('attributes.subscriptions.end_date') }}</th>
                        <th>{{ __('attributes.subscriptions.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->user?->name }}</td>
                        <td>{{ $subscription->plan?->name }}</td>
                        <td>{{ $subscription->end_date->toFormattedDateString() }}</td>
                        <td><span class="badge bg-info">{{ $subscription->status }}</span></td>
                        <td>
                            <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}">Edit</a>
                            <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">{{ __('attributes.subscriptions.no_records') }}</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($subscriptions->hasPages())
            <div class="card-footer">{{ $subscriptions->links() }}</div>
        @endif
    </div>
@endsection
