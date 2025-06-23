@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">{{ __('attributes.plans.title') }}</h3>
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary btn-sm">{{ __('attributes.plans.create') }}</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('attributes.plans.name') }}</th>
                        <th>{{ __('attributes.plans.price_monthly') }}</th>
                        <th>{{ __('attributes.plans.target_type') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($plans as $plan)
                    <tr>
                        <td>{{ $plan->getTranslation('name', app()->getLocale()) }}</td>
                        <td>{{ $plan->price_monthly }}</td>
                        <td><span class="badge bg-info">{{ $plan->target_type }}</span></td>
                        <td>
                            <a href="{{ route('admin.plans.edit', $plan->id) }}">{{ __('attributes.plans.edit') }}</a>
                            <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger">{{ __('attributes.plans.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">{{ __('attributes.plans.no_records') }}</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $plans->links() }}</div>
    </div>
@endsection
