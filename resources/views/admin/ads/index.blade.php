@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- Filter Card --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Filters</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ads.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Title..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="city_id" class="form-control">
                                        <option value="">-- All Cities --</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="">-- All Statuses --</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Ads Table Card --}}
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">All Ads</h6>
                    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary btn-sm">Create New Ad</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ad Details</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status / Actions</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agent</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ads as $ad)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if(!empty($ad->images) && isset($ad->images[0]))
                                                        <img src="{{ Storage::url($ad->images[0]) }}" class="avatar avatar-sm me-3" alt="{{ $ad->title }} thumbnail">
                                                    @else
                                                        <img src="https://via.placeholder.com/40/DEE2E6/868E96?text=Ad" class="avatar avatar-sm me-3" alt="No image">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $ad->title }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><p class="text-xs font-weight-bold mb-0">{{ optional($ad->district->city)->name }} - {{ optional($ad->district)->name }}</p></td>
                                        
                                        <td class="align-middle text-center text-sm">
                                            @if($ad->status == 'pending')
                                                <div class="btn-group" role="group" aria-label="Ad Actions">
                                                    <form action="{{ route('admin.ads.approve', $ad) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm mb-0">Approve</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $ad->id }}">
                                                        Reject
                                                    </button>
                                                </div>
                                            @else
                                                <span class="badge badge-sm 
                                                    @if($ad->status == 'active') bg-gradient-success
                                                    @elseif($ad->status == 'rejected') bg-gradient-danger
                                                    @else bg-gradient-secondary @endif">
                                                    {{ ucfirst($ad->status) }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ optional($ad->user)->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex justify-content-end gap-2 px-3">
                                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="Edit Ad">Edit</a>
                                                <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" data-toggle="tooltip" title="Delete Ad">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Rejection Modal for each ad --}}
                                    <div class="modal fade" id="rejectModal-{{ $ad->id }}" tabindex="-1" aria-labelledby="rejectModalLabel-{{ $ad->id }}" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel-{{ $ad->id }}">Reject Ad: {{ $ad->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          {{-- 1. Give the form a unique ID --}}
                                          <form id="reject-form-{{ $ad->id }}" action="{{ route('admin.ads.reject', $ad) }}" method="POST">
                                              @csrf
                                              <div class="modal-body">
                                                <div class="row">
                                                    {{-- Left Column: More Details --}}
                                                    <div class="col-md-8">
                                                        <h6 class="text-dark">Ad Details</h6>
                                                        <ul class="list-unstyled mb-0">
                                                            <li><strong>Agent:</strong> {{ optional($ad->user)->name }}</li>
                                                            <li><strong>Location:</strong> {{ optional($ad->district->city)->name }} - {{ optional($ad->district)->name }}</li>
                                                            <li><strong>Property Type:</strong> {{ optional($ad->propertyType)->name }}</li>
                                                            <li><strong>Purpose:</strong> <span class="badge bg-secondary">{{ $ad->listing_purpose == 'sale' ? 'For Sale' : 'For Rent' }}</span></li>
                                                            <li><strong>Price:</strong> {{ number_format($ad->total_price) }} SAR</li>
                                                            <li><strong>Area:</strong> {{ $ad->area_sq_meters }} m²</li>
                                                            <li><strong>Posted on:</strong> {{ $ad->created_at->format('M d, Y') }}</li>
                                                        </ul>
                                                        <hr class="my-2">
                                                        <p><strong>Description:</strong></p>
                                                        <p class="text-sm text-muted" style="max-height: 100px; overflow-y: auto;">
                                                            {{ $ad->description ?? 'No description provided.' }}
                                                        </p>
                                                    </div>
                                                    {{-- Right Column: Image and View Button --}}
                                                    <div class="col-md-4 d-flex flex-column">
                                                        <img src="{{ !empty($ad->images) && isset($ad->images[0]) ? Storage::url($ad->images[0]) : 'https://via.placeholder.com/200' }}" class="img-fluid rounded mb-2">
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <div class="form-group">
                                                    <label for="rejection_reason-{{ $ad->id }}">Reason for Rejection (Optional, will be sent to user)</label>
                                                    <textarea name="rejection_reason" id="rejection_reason-{{ $ad->id }}" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                {{-- 2. Change button type and add attributes for JS --}}
                                                <button type="button" class="btn btn-danger js-submit-reject-form" data-form-id="reject-form-{{ $ad->id }}">
                                                    Confirm Rejection
                                                </button>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                @empty
                                    <tr><td colspan="5" class="text-center py-4">No ads found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($ads->hasPages())
                    <div class="card-footer d-flex justify-content-center">
                        {{ $ads->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // --- SCRIPT TO MANUALLY TRIGGER THE MODAL ---
        
        // Find all buttons that are supposed to open a reject modal
        const rejectModalTriggers = document.querySelectorAll('button[data-bs-toggle="modal"]');

        rejectModalTriggers.forEach(button => {
            button.addEventListener('click', function() {
                // Get the target modal ID from the button's data-bs-target attribute
                const modalId = this.getAttribute('data-bs-target');
                const modalElement = document.querySelector(modalId);
                
                if (modalElement) {
                    // Use Bootstrap's own JavaScript API to create a modal instance and show it
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            });
        });


        // --- YOUR EXISTING SCRIPT TO HANDLE THE FORM SUBMISSION ---
        
        document.querySelectorAll('.js-submit-reject-form').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const formId = this.getAttribute('data-form-id');
                const form = document.getElementById(formId);

                if (!form) {
                    console.error('Could not find form with ID:', formId);
                    return;
                }

                this.disabled = true;
                this.textContent = 'Rejecting...';

                const formData = new FormData(form);
                const url = form.getAttribute('action');
                
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) throw new Error('Server responded with an error.');
                    return response.json();
                })
                .then(data => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('An error occurred. Please try again.');
                    this.disabled = false;
                    this.textContent = 'Confirm Rejection';
                });
            });
        });
    });
</script>

@endpush