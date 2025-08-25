@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Upgrade Requests</h3>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
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
                        <td>{{ optional($request->user)->name }} ({{ optional($request->user)->email }})</td>
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
                                <form action="{{ route('admin.upgrade-requests.approve', $request) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $request->id }}">
                                    Reject
                                </button>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" aria-labelledby="rejectModalLabel-{{ $request->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel-{{ $request->id }}">Reject Request for {{ optional($request->user)->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      {{-- The form has a unique ID for our JS to find --}}
                                      <form id="reject-form-{{ $request->id }}" action="{{ route('admin.upgrade-requests.reject', $request) }}" method="POST">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="form-group">
                                                <label for="rejection_reason-{{ $request->id }}">Reason for Rejection (Optional)</label>
                                                <textarea name="rejection_reason" id="rejection_reason-{{ $request->id }}" class="form-control" rows="3"></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {{-- This button is now type="button" and will be controlled by our script --}}
                                            <button type="button" class="btn btn-danger js-submit-reject-form" data-form-id="reject-form-{{ $request->id }}">
                                                Confirm Rejection
                                            </button>
                                          </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            @else
                                Processed by {{ optional($request->processor)->name ?? 'N/A' }} on {{ optional($request->processed_at)->format('Y-m-d') }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No upgrade requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($requests->hasPages())
        <div class="card-footer d-flex justify-content-center">
            {{ $requests->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Find all buttons with the specific class for rejecting
        document.querySelectorAll('.js-submit-reject-form').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Stop any default button behavior

                const formId = this.getAttribute('data-form-id');
                const form = document.getElementById(formId);

                if (!form) {
                    console.error('Could not find form with ID:', formId);
                    alert('An unexpected error occurred. Could not submit the form.');
                    return;
                }

                // Provide visual feedback to the admin
                this.disabled = true;
                this.textContent = 'Rejecting...';

                const formData = new FormData(form);
                const url = form.getAttribute('action');
                
                // Use the Fetch API to submit the form data in the background
                fetch(url, {
                    method: 'POST', // The form's method is POST
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'), // Important for security
                        'Accept': 'application/json', // Tell Laravel we want a JSON response
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        // Handle server errors (e.g., 500, 404)
                        throw new Error('Server responded with an error status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    // On a successful response from the controller, reload the page
                    // to show the updated status in the table.
                    window.location.reload();
                })
                .catch(error => {
                    // Handle network errors or server errors
                    console.error('Fetch error:', error);
                    alert('An error occurred while rejecting the request. Please check the console and try again.');
                    // Restore the button so the admin can try again
                    this.disabled = false;
                    this.textContent = 'Confirm Rejection';
                });
            });
        });
    });
</script>
@endpush