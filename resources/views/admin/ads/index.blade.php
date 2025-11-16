@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- Filter Card --}}
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>@lang('admin.ads.filters')</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.ads.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="@lang('admin.ads.search_by_title')" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="city_id" class="form-control">
                                        <option value="">@lang('admin.ads.all_cities')</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="">@lang('admin.ads.all_statuses')</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>@lang('admin.ads.pending')</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>@lang('admin.ads.active')</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>@lang('admin.ads.rejected')</option>
                                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>@lang('admin.ads.expired')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">@lang('admin.ads.filter')</button>
                                <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">@lang('admin.ads.reset')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Ads Table Card --}}
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">@lang('admin.ads.all_ads')</h6>
                    <a href="{{ route('admin.ads.create') }}" class="btn btn-primary btn-sm">@lang('admin.ads.create_new_ad')</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('admin.ads.ad_details')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('admin.ads.location')</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('admin.ads.status_actions')</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('admin.ads.agent')</th>
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
                                                        <button type="submit" class="btn btn-success btn-sm mb-0">@lang('admin.ads.approve')</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $ad->id }}">
                                                        @lang('admin.ads.reject')
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
                                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="@lang('admin.ads.edit_ad_title')">@lang('admin.edit')</a>
                                                <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST" class="d-inline" onsubmit="return confirm('@lang('admin.ads.are_you_sure')')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" data-toggle="tooltip" title="@lang('admin.ads.delete_ad_title')">@lang('admin.delete')</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Rejection Modal for each ad --}}
                                    <div class="modal fade" id="rejectModal-{{ $ad->id }}" tabindex="-1" aria-labelledby="rejectModalLabel-{{ $ad->id }}" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel-{{ $ad->id }}">@lang('admin.ads.reject_ad_title', ['title' => $ad->title])</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('admin.ads.close')"></button>
                                          </div>
                                          {{-- 1. Give the form a unique ID --}}
                                          <form id="reject-form-{{ $ad->id }}" action="{{ route('admin.ads.reject', $ad) }}" method="POST">
                                              @csrf
                                              <div class="modal-body">
                                                <div class="row">
                                                    {{-- Left Column: More Details --}}
                                                    <div class="col-md-8">
                                                        <h6 class="text-dark">@lang('admin.ads.ad_details')</h6>
                                                        <ul class="list-unstyled mb-0">
                                                            <li><strong>@lang('admin.ads.agent_colon')</strong> {{ optional($ad->user)->name }}</li>
                                                            <li><strong>@lang('admin.ads.location_colon')</strong> {{ optional($ad->district->city)->name }} - {{ optional($ad->district)->name }}</li>
                                                            <li><strong>@lang('admin.ads.property_type_colon')</strong> {{ optional($ad->propertyType)->name }}</li>
                                                            <li><strong>@lang('admin.ads.purpose_colon')</strong> <span class="badge bg-secondary">{{ $ad->listing_purpose == 'sale' ? __('admin.ads.for_sale') : __('admin.ads.for_rent') }}</span></li>
                                                            <li><strong>@lang('admin.ads.price_colon')</strong> {{ number_format($ad->total_price) }} SAR</li>
                                                            <li><strong>@lang('admin.ads.area_colon')</strong> {{ $ad->area_sq_meters }} m²</li>
                                                            <li><strong>@lang('admin.ads.posted_on_colon')</strong> {{ $ad->created_at->format('M d, Y') }}</li>
                                                        </ul>
                                                        <hr class="my-2">
                                                        <p><strong>@lang('admin.ads.description_colon')</strong></p>
                                                        <p class="text-sm text-muted" style="max-height: 100px; overflow-y: auto;">
                                                            {{ $ad->description ?? __('admin.ads.no_description_provided') }}
                                                        </p>
                                                    </div>
                                                    {{-- Right Column: Image and View Button --}}
                                                    <div class="col-md-4 d-flex flex-column">
                                                        <img src="{{ !empty($ad->images) && isset($ad->images[0]) ? Storage::url($ad->images[0]) : 'https://via.placeholder.com/200' }}" class="img-fluid rounded mb-2">
                                                    </div>
                                                </div>
                                                <hr class="my-3">
                                                <div class="form-group">
                                                    <label for="rejection_reason-{{ $ad->id }}">@lang('admin.ads.rejection_reason_label')</label>
                                                    <textarea name="rejection_reason" id="rejection_reason-{{ $ad->id }}" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.ads.close')</button>
                                                {{-- 2. Change button type and add attributes for JS --}}
                                                <button type="button" class="btn btn-danger js-submit-reject-form" data-form-id="reject-form-{{ $ad->id }}">
                                                    @lang('admin.ads.confirm_rejection')
                                                </button>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                @empty
                                    <tr><td colspan="5" class="text-center py-4">@lang('admin.ads.no_ads_found')</td></tr>
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
                this.textContent = '@lang('admin.ads.rejecting')';

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
                    alert('@lang('admin.ads.error_occurred')');
                    this.disabled = false;
                    this.textContent = '@lang('admin.ads.confirm_rejection')';
                });
            });
        });
    });
</script>

@endpush