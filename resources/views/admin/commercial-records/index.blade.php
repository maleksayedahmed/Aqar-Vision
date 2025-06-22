@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>{{ __('attributes.commercial_records.title') }}</h6>
                            <a href="{{ route('admin.commercial-records.create') }}" class="btn btn-primary btn-sm">
                                {{ __('attributes.commercial_records.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('attributes.commercial_records.agency_id') }}</th>
                                        <th>{{ __('attributes.commercial_records.commercial_register_number') }}</th>
                                        <th>{{ __('attributes.commercial_records.commercial_issue_date') }}</th>
                                        <th>{{ __('attributes.commercial_records.commercial_expiry_date') }}</th>
                                        <th>{{ __('attributes.commercial_records.city') }}</th>
                                        <th>{{ __('attributes.commercial_records.address') }}</th>
                                        <th>{{ __('attributes.commercial_records.created_at') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($commercialRecords as $record)
                                        <tr>
                                            <td>{{ $record->agency?->agency_name ?? '-' }}</td>
                                            <td>{{ $record->commercial_register_number }}</td>
                                            <td>{{ $record->commercial_issue_date?->format('Y-m-d') }}</td>
                                            <td>{{ $record->commercial_expiry_date?->format('Y-m-d') }}</td>
                                            <td>{{ $record->city }}</td>
                                            <td>{{ $record->address }}</td>
                                            <td>{{ $record->created_at?->format('Y-m-d') }}</td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.commercial-records.edit', $record->id) }}"
                                                        class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        {{ __('attributes.commercial_records.edit') }}
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.commercial-records.destroy', $record->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-danger font-weight-bold text-xs border-0 bg-transparent"
                                                            data-toggle="tooltip" data-original-title="Delete">
                                                            {{ __('attributes.commercial_records.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                {{ __('attributes.commercial_records.no_records') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $commercialRecords->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
