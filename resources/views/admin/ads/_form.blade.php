{{-- Add Leaflet CSS to the head section of the layout --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 400px; } /* Ensure map has a defined height */
    </style>
@endpush

<div class="card-body">
    {{-- Main Details --}}
    <h5 class="mb-3">Main Details</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $ad->title) }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_id">Ad Owner (User/Agent)</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Select an Owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $ad->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $ad->description) }}</textarea>
            </div>
        </div>
    </div>

    <hr><h5 class="mt-4">Property Details</h5>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="form-group">
                <label for="property_type_id">Property Type</label>
                <select name="property_type_id" class="form-control" required>
                    <option value="">Select a Type</option>
                    @foreach($propertyTypes as $type)
                        <option value="{{ $type->id }}" {{ old('property_type_id', $ad->property_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="listing_purpose">Listing Purpose</label>
                <select name="listing_purpose" class="form-control" required>
                    <option value="sale" {{ old('listing_purpose', $ad->listing_purpose) == 'sale' ? 'selected' : '' }}>For Sale</option>
                    <option value="rent" {{ old('listing_purpose', $ad->listing_purpose) == 'rent' ? 'selected' : '' }}>For Rent</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="total_price">Total Price (SAR)</label>
                <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price', $ad->total_price) }}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="area_sq_meters">Area (m²)</label>
                <input type="number" step="0.01" name="area_sq_meters" class="form-control" value="{{ old('area_sq_meters', $ad->area_sq_meters) }}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="rooms">Number of Rooms</label>
                <input type="number" name="rooms" class="form-control" value="{{ old('rooms', $ad->rooms) }}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="bathrooms">Number of Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $ad->bathrooms) }}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="age_years">Property Age (Years)</label>
                <input type="number" name="age_years" class="form-control" value="{{ old('age_years', $ad->age_years) }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="floor_number">Floor Number</label>
                <input type="text" name="floor_number" class="form-control" value="{{ old('floor_number', $ad->floor_number) }}">
            </div>
        </div>
    </div>

    <hr><h5 class="mt-4">Location Details</h5>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="city_id_select">City</label>
                <select id="city-select" class="form-control">
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $ad->district?->city_id) == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" id="district-select" class="form-control" required>
                    <option value="">Select City First</option>
                    @if($ad->district)
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district_id', $ad->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
             <div class="form-group">
                <label for="province">Province</label>
                <input type="text" name="province" class="form-control" value="{{ old('province', $ad->province) }}">
            </div>
        </div>
        <div class="col-md-8">
             <div class="form-group">
                <label for="street_name">Street Name</label>
                <input type="text" name="street_name" class="form-control" value="{{ old('street_name', $ad->street_name) }}">
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <label class="d-block mb-2">Location on Map</label>
        <p class="text-muted mb-2">Drag the pin to set the exact location.</p>
        <div id="map" class="w-100 rounded z-0"></div>
    </div>
    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $ad->latitude ?? '24.7136') }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $ad->longitude ?? '46.6753') }}">


    <hr><h5 class="mt-4">Features</h5>
    <div class="row mt-3">
        @foreach($features as $feature)
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="features[{{ str_replace(' ', '_', strtolower($feature->getTranslation('name', 'en'))) }}]" value="1" 
                           id="feature_{{ $feature->id }}" 
                           @if(is_array(old('features', $ad->features)) && array_key_exists(str_replace(' ', '_', strtolower($feature->getTranslation('name', 'en'))), old('features', $ad->features))) checked @endif>
                    <label class="form-check-label" for="feature_{{ $feature->id }}">{{ $feature->name }}</label>
                </div>
            </div>
        @endforeach
    </div>

    <hr><h5 class="mt-4">Additional Details</h5>
    <div class="row mt-3">
        <div class="col-md-4"><div class="form-group"><label for="finishing_status">Finishing Status</label><input type="text" name="finishing_status" class="form-control" value="{{ old('finishing_status', $ad->finishing_status) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="facade">Facade</label><input type="text" name="facade" class="form-control" value="{{ old('facade', $ad->facade) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="property_usage">Usage</label><input type="text" name="property_usage" class="form-control" value="{{ old('property_usage', $ad->property_usage) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="plan_number">Plan Number</label><input type="text" name="plan_number" class="form-control" value="{{ old('plan_number', $ad->plan_number) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="is_mortgaged">Is Mortgaged</label><select name="is_mortgaged" class="form-control"><option value="0" {{ old('is_mortgaged', $ad->is_mortgaged) == '0' ? 'selected' : '' }}>No</option><option value="1" {{ old('is_mortgaged', $ad->is_mortgaged) == '1' ? 'selected' : '' }}>Yes</option></select></div></div>
        <div class="col-md-4"><div class="form-group"><label for="furniture_status">Furniture</label><input type="text" name="furniture_status" class="form-control" value="{{ old('furniture_status', $ad->furniture_status) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="building_status">Building Status</label><input type="text" name="building_status" class="form-control" value="{{ old('building_status', $ad->building_status) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="building_number">Building Number</label><input type="text" name="building_number" class="form-control" value="{{ old('building_number', $ad->building_number) }}"></div></div>
        <div class="col-md-4"><div class="form-group"><label for="postal_code">Postal Code</label><input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $ad->postal_code) }}"></div></div>
    </div>
    
    <hr><h5 class="mt-4">Status & Moderation</h5>
     <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ old('status', $ad->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status', $ad->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="rejected" {{ old('status', $ad->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="expired" {{ old('status', $ad->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
        </div>
     </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save Ad</button>
</div>

@push('scripts')
{{-- Leaflet JS for the map --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- DYNAMIC CITY/DISTRICT DROPDOWN LOGIC ---
        const citySelect = document.getElementById('city-select');
        const districtSelect = document.getElementById('district-select');

        function fetchDistricts(cityId, selectedDistrictId = null) {
            if (!cityId) {
                districtSelect.innerHTML = '<option value="">Select City First</option>';
                districtSelect.disabled = true;
                return;
            }
            fetch(`/get-districts/${cityId}`)
                .then(response => response.json())
                .then(districts => {
                    districtSelect.innerHTML = '<option value="">Select a District</option>';
                    districts.forEach(district => {
                        const option = new Option(district.name, district.id);
                        if (district.id == selectedDistrictId) {
                            option.selected = true;
                        }
                        districtSelect.add(option);
                    });
                    districtSelect.disabled = false;
                });
        }
        
        citySelect.addEventListener('change', function() {
            fetchDistricts(this.value);
        });

        if(citySelect.value) {
            fetchDistricts(citySelect.value, "{{ old('district_id', $ad->district_id ?? '') }}");
        }

        // --- MAP INITIALIZATION LOGIC ---
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const defaultLat = parseFloat(latInput.value);
        const defaultLng = parseFloat(lngInput.value);

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        marker.on('dragend', function (e) {
            const newPosition = marker.getLatLng();
            latInput.value = newPosition.lat.toFixed(7);
            lngInput.value = newPosition.lng.toFixed(7);
        });
    });
</script>
@endpush