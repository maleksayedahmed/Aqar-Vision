@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Upgrade Requests</h3>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Requested Role</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->user->name }} ({{ $request->user->email }})</td>
                        <td><span class="badge bg-info">{{ ucfirst($request->requested_role) }}</span></td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                        <td>
                             @if($request->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($request->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending')
                                <form action="{{ route('admin.upgrade-requests.approve', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $request->id }}">
                                    Reject
                                </button>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel">Reject Request for {{ $request->user->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="{{ route('admin.upgrade-requests.reject', $request->id) }}" method="POST">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="form-group">
                                                <label for="rejection_reason">Reason for Rejection (Optional)</label>
                                                <textarea name="rejection_reason" class="form-control" rows="3"></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                          </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            @else
                                Processed on {{ $request->processed_at?->format('Y-m-d') }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No upgrade requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $requests->links() }}
    </div>
</div>
@endsection
