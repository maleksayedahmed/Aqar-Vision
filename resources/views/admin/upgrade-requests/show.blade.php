@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">@lang('admin.upgrade_requests.agency_upgrade_request_details')</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>@lang('admin.upgrade_requests.user_information')</h4>
                <p><strong>@lang('admin.upgrade_requests.name'):</strong> {{ $request->user->name }}</p>
                <p><strong>@lang('admin.upgrade_requests.email'):</strong> {{ $request->user->email }}</p>
                <p><strong>@lang('admin.upgrade_requests.phone'):</strong> {{ $request->user->phone }}</p>
            </div>
            <div class="col-md-6">
                <h4>@lang('admin.upgrade_requests.agency_information')</h4>
                <p><strong>@lang('admin.upgrade_requests.agency_name'):</strong> {{ $request->agencyUpgradeRequest->agency_name }}</p>
                <p><strong>@lang('admin.upgrade_requests.agency_type'):</strong> {{ $request->agencyUpgradeRequest->agencyType->name }}</p>
                <p><strong>@lang('admin.upgrade_requests.commercial_register_number'):</strong> {{ $request->agencyUpgradeRequest->commercial_register_number }}</p>
                <p><strong>@lang('admin.upgrade_requests.commercial_issue_date'):</strong> {{ $request->agencyUpgradeRequest->commercial_issue_date }}</p>
                <p><strong>@lang('admin.upgrade_requests.commercial_expiry_date'):</strong> {{ $request->agencyUpgradeRequest->commercial_expiry_date }}</p>
                <p><strong>@lang('admin.upgrade_requests.tax_id'):</strong> {{ $request->agencyUpgradeRequest->tax_id }}</p>
                <p><strong>@lang('admin.upgrade_requests.tax_issue_date'):</strong> {{ $request->agencyUpgradeRequest->tax_issue_date }}</p>
                <p><strong>@lang('admin.upgrade_requests.tax_expiry_date'):</strong> {{ $request->agencyUpgradeRequest->tax_expiry_date }}</p>
                <p><strong>@lang('admin.upgrade_requests.address'):</strong> {{ $request->agencyUpgradeRequest->address }}</p>
                <p><strong>@lang('admin.upgrade_requests.phone_number'):</strong> {{ $request->agencyUpgradeRequest->phone_number }}</p>
                <p><strong>@lang('admin.upgrade_requests.email'):</strong> {{ $request->agencyUpgradeRequest->email }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        @if($request->status == 'pending')
            <form action="{{ route('admin.upgrade-requests.approve', $request) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('@lang('admin.upgrade_requests.confirm_approve')')">@lang('admin.upgrade_requests.approve')</button>
            </form>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $request->id }}">
                @lang('admin.upgrade_requests.reject')
            </button>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" aria-labelledby="rejectModalLabel-{{ $request->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel-{{ $request->id }}">@lang('admin.upgrade_requests.reject_request_for', ['name' => $request->user->name])</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="reject-form-{{ $request->id }}" action="{{ route('admin.upgrade-requests.reject', $request) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="rejection_reason-{{ $request->id }}">@lang('admin.upgrade_requests.rejection_reason_optional')</label>
                            <textarea name="rejection_reason" id="rejection_reason-{{ $request->id }}" class="form-control" rows="3" placeholder="@lang('admin.upgrade_requests.enter_rejection_reason')"></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.upgrade_requests.cancel')</button>
                        <button type="submit" class="btn btn-danger">@lang('admin.upgrade_requests.confirm_rejection')</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
        @else
            <p>@lang('admin.upgrade_requests.already_processed')</p>
        @endif
    </div>
</div>
@endsection
