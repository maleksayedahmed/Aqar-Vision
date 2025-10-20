@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('common.user_upgrade_requests') }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th>{{ __('common.user_info') }}</th>
                        <th>{{ __('common.requested_role') }}</th>
                        <th>{{ __('common.request_date') }}</th>
                        <th>{{ __('common.status') }}</th>
                        <th>{{ __('common.additional_info') }}</th>
                        <th>{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <strong>{{ optional($request->user)->name }}</strong>
                                    <small class="text-muted">{{ optional($request->user)->email }}</small>
                                    @if (optional($request->user)->phone)
                                        <small class="text-muted">{{ __('common.phone') }}:
                                            {{ optional($request->user)->phone }}</small>
                                    @endif
                                    @if ($request->license)
                                        <small class="text-muted">{{ __('common.fal_license') }}:
                                            {{ $request->license->license_number }}</small>
                                        @if ($request->license->issue_date)
                                            <small class="text-muted">{{ __('common.license_issue_date') }}:
                                                {{ $request->license->issue_date->format('Y-m-d') }}</small>
                                        @endif
                                        @if ($request->license->expiry_date)
                                            <small class="text-muted">{{ __('common.license_expiry_date') }}:
                                                {{ $request->license->expiry_date->format('Y-m-d') }}</small>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $request->requested_role == 'agent' ? 'bg-info' : 'bg-primary' }}">
                                    {{ $request->requested_role == 'agent' ? __('common.real_estate_marketer') : __('common.real_estate_company') }}
                                </span>
                            </td>
                            <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if ($request->status == 'pending')
                                    <span class="badge bg-warning">{{ __('common.pending') }}</span>
                                @elseif($request->status == 'approved')
                                    <span class="badge bg-success">{{ __('common.approved') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('common.status_rejected') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($request->status != 'pending')
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">{{ __('common.processed_by') }}:
                                            {{ optional($request->processor)->name ?? __('common.not_specified') }}</small>
                                        <small class="text-muted">{{ __('common.processed_at') }}:
                                            {{ optional($request->processed_at)->format('Y-m-d H:i') ?? __('common.not_specified') }}</small>
                                        @if ($request->admin_notes)
                                            <small class="text-muted">{{ __('common.notes') }}:
                                                {{ \Illuminate\Support\Str::limit($request->admin_notes, 50) }}</small>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($request->requested_role == 'agency')
                                    <a href="{{ route('admin.upgrade-requests.show', $request) }}"
                                        class="btn btn-info btn-sm">{{ __('common.view_details') }}</a>
                                @endif
                                @if ($request->status == 'pending')
                                    <form action="{{ route('admin.upgrade-requests.approve', $request) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                            onclick="return confirm('{{ __('common.are_you_sure_approve') }}')">{{ __('common.accept') }}</button>
                                    </form>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal-{{ $request->id }}">
                                        {{ __('common.reject') }}
                                    </button>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1"
                                        aria-labelledby="rejectModalLabel-{{ $request->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel-{{ $request->id }}">
                                                        {{ __('common.reject') }} - {{ optional($request->user)->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                {{-- The form has a unique ID for our JS to find --}}
                                                <form id="reject-form-{{ $request->id }}"
                                                    action="{{ route('admin.upgrade-requests.reject', $request) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label
                                                                for="rejection_reason-{{ $request->id }}">{{ __('common.reject_reason_optional') }}</label>
                                                            <textarea name="rejection_reason" id="rejection_reason-{{ $request->id }}" class="form-control" rows="3"
                                                                placeholder="{{ __('common.write_reject_reason_here') }}"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('common.cancel') }}</button>
                                                        {{-- This button is now type="button" and will be controlled by our script --}}
                                                        <button type="button" class="btn btn-danger js-submit-reject-form"
                                                            data-form-id="reject-form-{{ $request->id }}">
                                                            {{ __('common.confirm_reject') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">{{ __('common.processed') }}</span>
                                    @if ($request->admin_notes)
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#notesModal-{{ $request->id }}">
                                            {{ __('common.view_notes') }}
                                        </button>

                                        <!-- Notes Modal -->
                                        <div class="modal fade" id="notesModal-{{ $request->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ __('common.notes') }}</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $request->admin_notes }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('common.ok') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">{{ __('common.no_upgrade_requests') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($requests->hasPages())
            <div class="card-footer d-flex justify-content-center">
                {{ $requests->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure modals open even if data attribute handling isn't wired up by the admin template.
            // This attaches a click handler to any element using data-bs-toggle="modal" and
            // uses the available modal API (Bootstrap or CoreUI) to show the modal.
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    try {
                        const target = this.getAttribute('data-bs-target') || this.getAttribute(
                            'data-target');
                        if (!target) return;
                        const modalEl = document.querySelector(target);
                        if (!modalEl) return;

                        // Prevent default so the data attribute doesn't rely on missing handlers
                        e.preventDefault();

                        if (window.bootstrap && bootstrap.Modal) {
                            const inst = bootstrap.Modal.getInstance(modalEl) || new bootstrap
                                .Modal(modalEl);
                            inst.show();
                            return;
                        }

                        if (window.coreui && coreui.Modal) {
                            const inst = coreui.Modal.getInstance ? coreui.Modal.getInstance(
                                modalEl) || new coreui.Modal(modalEl) : new coreui.Modal(
                                modalEl);
                            inst.show();
                            return;
                        }

                        // Minimal fallback: toggle classes so modal becomes visible
                        modalEl.classList.add('show');
                        modalEl.style.display = 'block';
                        modalEl.removeAttribute('aria-hidden');
                    } catch (err) {
                        // Keep console noise minimal but useful during debugging
                        console.warn('Modal show fallback failed', err);
                    }
                });
            });

            // Find all buttons with the specific class for rejecting
            document.querySelectorAll('.js-submit-reject-form').forEach(button => {
                button.addEventListener('click', function(event) {
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
                    this.textContent = '{{ __('common.rejecting_in_progress') }}';

                    const formData = new FormData(form);
                    const url = form.getAttribute('action');

                    // Use the Fetch API to submit the form data in the background
                    fetch(url, {
                            method: 'POST', // The form's method is POST
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': formData.get(
                                    '_token'), // Important for security
                                'Accept': 'application/json', // Tell Laravel we want a JSON response
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                // Handle server errors (e.g., 500, 404)
                                throw new Error('Server responded with an error status: ' +
                                    response.status);
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
                            alert('{{ __('common.error_during_reject') }}');
                            // Restore the button so the admin can try again
                            this.disabled = false;
                            this.textContent = '{{ __('common.confirm_reject') }}';
                        });
                });
            });
        });
    </script>
@endpush
