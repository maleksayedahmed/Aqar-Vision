@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Agency Upgrade Request Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>User Information</h4>
                <p><strong>Name:</strong> {{ $request->user->name }}</p>
                <p><strong>Email:</strong> {{ $request->user->email }}</p>
                <p><strong>Phone:</strong> {{ $request->user->phone }}</p>
            </div>
            <div class="col-md-6">
                <h4>Agency Information</h4>
                <p><strong>Agency Name:</strong> {{ $request->agencyUpgradeRequest->agency_name }}</p>
                <p><strong>Agency Type:</strong> {{ $request->agencyUpgradeRequest->agencyType->name }}</p>
                <p><strong>Commercial Register Number:</strong> {{ $request->agencyUpgradeRequest->commercial_register_number }}</p>
                <p><strong>Commercial Issue Date:</strong> {{ $request->agencyUpgradeRequest->commercial_issue_date }}</p>
                <p><strong>Commercial Expiry Date:</strong> {{ $request->agencyUpgradeRequest->commercial_expiry_date }}</p>
                <p><strong>Tax ID:</strong> {{ $request->agencyUpgradeRequest->tax_id }}</p>
                <p><strong>Tax Issue Date:</strong> {{ $request->agencyUpgradeRequest->tax_issue_date }}</p>
                <p><strong>Tax Expiry Date:</strong> {{ $request->agencyUpgradeRequest->tax_expiry_date }}</p>
                <p><strong>Address:</strong> {{ $request->agencyUpgradeRequest->address }}</p>
                <p><strong>Phone Number:</strong> {{ $request->agencyUpgradeRequest->phone_number }}</p>
                <p><strong>Email:</strong> {{ $request->agencyUpgradeRequest->email }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer">
        @if($request->status == 'pending')
            <form action="{{ route('admin.upgrade-requests.approve', $request) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this request?')">Approve</button>
            </form>

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $request->id }}">
                Reject
            </button>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" aria-labelledby="rejectModalLabel-{{ $request->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel-{{ $request->id }}">Reject Request for {{ $request->user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="reject-form-{{ $request->id }}" action="{{ route('admin.upgrade-requests.reject', $request) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group">
                            <label for="rejection_reason-{{ $request->id }}">Rejection Reason (optional)</label>
                            <textarea name="rejection_reason" id="rejection_reason-{{ $request->id }}" class="form-control" rows="3" placeholder="Enter rejection reason here..."></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
        @else
            <p>This request has already been processed.</p>
        @endif
    </div>
</div>
@endsection
