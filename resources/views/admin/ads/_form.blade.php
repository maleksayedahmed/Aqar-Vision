@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-section {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .form-section:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }
        
        .section-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 24px;
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-content {
            padding: 24px;
        }
        
        #map { 
            height: 400px; 
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .media-thumbnail { 
            width: 150px; 
            height: 100px; 
            object-fit: cover; 
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .media-thumbnail:hover {
            transform: scale(1.05);
            border-color: #667eea;
        }
        
        .media-container {
            position: relative;
            display: inline-block;
        }
        
        .delete-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(220, 53, 69, 0.8);
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .media-container input:checked + .delete-overlay {
            display: flex;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .form-check {
            background: #f8f9fa;
            padding: 12px 16px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .form-check:hover {
            background: #e9ecef;
        }
        
        .form-check-input:checked + .form-check-label {
            color: #667eea;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 14px 32px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.4);
        }
        
        .video-container {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 8px;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-active { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }
        .status-expired { background: #d1ecf1; color: #0c5460; }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }
        
        .file-input-label {
            display: block;
            padding: 12px 16px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input-label:hover {
            background: #e9ecef;
            border-color: #667eea;
        }
        
        .price-display {
            font-size: 1.1rem;
            font-weight: 600;
            color: #28a745;
        }
        
        .required-field::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }
    </style>
@endpush

<div class="container-fluid">
    <!-- Media Management Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-images"></i>
            Media Management
        </div>
        <div class="section-content">
            @if($ad->images && count($ad->images) > 0)
            <div class="mb-4">
                <label class="form-label">Current Images <small class="text-muted">(Check to delete)</small></label>
                <div class="d-flex flex-wrap gap-3 mt-2">
                    @foreach($ad->images as $imagePath)
                    <div class="media-container">
                        <img src="{{ Storage::url($imagePath) }}" class="media-thumbnail" alt="Property Image">
                        <input class="form-check-input position-absolute" type="checkbox" name="delete_images[]" value="{{ $imagePath }}" id="delete_{{ $loop->index }}" style="top: 8px; right: 8px; z-index: 10;">
                        <div class="delete-overlay">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="form-group">
                <label class="form-label" for="images">
                    <i class="fas fa-upload me-2"></i>Upload New Images
                </label>
                <div class="file-input-wrapper">
                    <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                    <label for="images" class="file-input-label">
                        <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i><br>
                        Click to select images or drag and drop
                    </label>
                </div>
            </div>

            @if($ad->video_path)
            <div class="form-group mt-4">
                <label class="form-label">Current Video</label>
                <div class="video-container">
                    <video src="{{ Storage::url($ad->video_path) }}" controls class="w-100" style="max-width: 400px;"></video>
                </div>
            </div>
            @endif
            
            <div class="form-group">
                <label class="form-label" for="video">
                    <i class="fas fa-video me-2"></i>Upload/Replace Video
                </label>
                <div class="file-input-wrapper">
                    <input type="file" name="video" id="video" class="form-control" accept="video/*">
                    <label for="video" class="file-input-label">
                        <i class="fas fa-video fa-2x mb-2"></i><br>
                        Click to select video file
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Details Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-info-circle"></i>
            Main Details
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label required-field" for="title">Property Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $ad->title) }}" required placeholder="Enter property title">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label required-field" for="user_id">Property Owner</label>
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
                        <label class="form-label" for="description">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Describe the property features, location, and other details...">{{ old('description', $ad->description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Details Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-home"></i>
            Property Details
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label required-field" for="property_type_id">Property Type</label>
                        <select name="property_type_id" class="form-control" required>
                            <option value="">Select a Type</option>
                            @foreach($propertyTypes as $type)
                            <option value="{{ $type->id }}" {{ old('property_type_id', $ad->property_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label required-field" for="listing_purpose">Listing Purpose</label>
                        <select name="listing_purpose" class="form-control" required>
                            <option value="sale" {{ old('listing_purpose', $ad->listing_purpose) == 'sale' ? 'selected' : '' }}>
                                <i class="fas fa-tag"></i> For Sale
                            </option>
                            <option value="rent" {{ old('listing_purpose', $ad->listing_purpose) == 'rent' ? 'selected' : '' }}>
                                <i class="fas fa-key"></i> For Rent
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label required-field" for="total_price">Total Price</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price', $ad->total_price) }}" required placeholder="0.00">
                            <span class="input-group-text">SAR</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label required-field" for="area_sq_meters">Area</label>
                        <div class="input-group">
                            <input type="number" step="0.01" name="area_sq_meters" class="form-control" value="{{ old('area_sq_meters', $ad->area_sq_meters) }}" required placeholder="0.00">
                            <span class="input-group-text">m²</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="age_years">Property Age</label>
                        <div class="input-group">
                            <input type="number" name="age_years" class="form-control" value="{{ old('age_years', $ad->age_years) }}" placeholder="0">
                            <span class="input-group-text">Years</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="is_mortgaged">Mortgage Status</label>
                        <select name="is_mortgaged" class="form-control">
                            <option value="0" {{ old('is_mortgaged', $ad->is_mortgaged) == '0' ? 'selected' : '' }}>
                                <i class="fas fa-check-circle text-success"></i> Not Mortgaged
                            </option>
                            <option value="1" {{ old('is_mortgaged', $ad->is_mortgaged) == '1' ? 'selected' : '' }}>
                                <i class="fas fa-university text-warning"></i> Mortgaged
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Location Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-map-marker-alt"></i>
            Location Details
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="city_id_select">City</label>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label required-field" for="district_id">District</label>
                        <select name="district_id" id="district-select" class="form-control" required>
                            <option value="">Select City First</option>
                            @if($ad->district)
                                @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id', $ad->district_id) == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                                @endforeach 
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <label class="form-label">
                    <i class="fas fa-map me-2"></i>Property Location <small class="text-muted">(Drag the marker to adjust)</small>
                </label>
                <div id="map" class="w-100"></div>
            </div>
            
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $ad->latitude ?? '24.7136') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $ad->longitude ?? '46.6753') }}">
        </div>
    </div>

    <!-- Features Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-list-check"></i>
            Property Features
        </div>
        <div class="section-content">
            <div class="row">
                @foreach($features as $feature)
                    @php $slug = str_replace(' ', '_', strtolower($feature->getTranslation('name', 'en'))); @endphp
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="features[{{ $slug }}]" value="1" 
                                   id="feature_{{ $feature->id }}" 
                                   @if(is_array(old('features', $ad->features)) && array_key_exists($slug, old('features', $ad->features))) checked @endif>
                            <label class="form-check-label" for="feature_{{ $feature->id }}">
                                {{ $feature->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Additional Details Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-cog"></i>
            Additional Details
        </div>
        <div class="section-content">
            <div class="row">
                @foreach($attributes as $attribute)
                    @php
                        $slug = str_replace(' ', '_', strtolower($attribute->getTranslation('name', 'en')));
                        $currentValue = old('features.' . $slug, data_get($ad->features, $slug));
                    @endphp
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="attr_{{ $slug }}">{{ $attribute->name }}</label>
                            @if($attribute->type === 'dropdown')
                                <select name="features[{{ $slug }}]" id="attr_{{ $slug }}" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach($attribute->choices as $choice)
                                        <option value="{{ $choice['en'] }}" {{ $currentValue == $choice['en'] ? 'selected' : '' }}>
                                            {{ $choice[app()->getLocale()] ?? $choice['en'] }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $attribute->type }}" name="features[{{ $slug }}]" id="attr_{{ $slug }}" value="{{ $currentValue }}" class="form-control">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Status Section -->
    <div class="form-section">
        <div class="section-header">
            <i class="fas fa-flag"></i>
            Status & Moderation
        </div>
        <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label required-field" for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ old('status', $ad->status) == 'pending' ? 'selected' : '' }}>
                                🟡 Pending Review
                            </option>
                            <option value="active" {{ old('status', $ad->status) == 'active' ? 'selected' : '' }}>
                                🟢 Active
                            </option>
                            <option value="rejected" {{ old('status', $ad->status) == 'rejected' ? 'selected' : '' }}>
                                🔴 Rejected
                            </option>
                            <option value="expired" {{ old('status', $ad->status) == 'expired' ? 'selected' : '' }}>
                                ⏰ Expired
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="alert alert-info w-100">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Current Status:</strong> 
                        <span class="status-badge status-{{ old('status', $ad->status) }}">
                            {{ ucfirst(old('status', $ad->status)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="form-section">
    <div class="section-content text-center">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save me-2"></i>Save Property Ad
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg ms-3">
            <i class="fas fa-arrow-left me-2"></i>Cancel
        </a>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // City/District functionality
        const citySelect = document.getElementById('city-select');
        const districtSelect = document.getElementById('district-select');
        
        function fetchDistricts(cityId, selectedDistrictId = null) {
            if (!cityId) { 
                districtSelect.innerHTML = '<option value="">Select City First</option>'; 
                districtSelect.disabled = true; 
                return; 
            }
            
            // Add loading state
            districtSelect.innerHTML = '<option value="">Loading districts...</option>';
            districtSelect.disabled = true;
            
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
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                    districtSelect.innerHTML = '<option value="">Error loading districts</option>';
                });
        }
        
        citySelect.addEventListener('change', function() { 
            fetchDistricts(this.value); 
        });
        
        if(citySelect.value) { 
            fetchDistricts(citySelect.value, "{{ old('district_id', $ad->district_id ?? '') }}"); 
        }

        // Map functionality
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const map = L.map('map').setView([latInput.value, lngInput.value], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        const marker = L.marker([latInput.value, lngInput.value], { 
            draggable: true 
        }).addTo(map);
        
        marker.on('dragend', function (e) {
            const newPosition = marker.getLatLng();
            latInput.value = newPosition.lat.toFixed(7);
            lngInput.value = newPosition.lng.toFixed(7);
        });

        // File input enhancements
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                const fileCount = this.files.length;
                if (fileCount > 0) {
                    if (this.multiple) {
                        label.innerHTML = `<i class="fas fa-check-circle fa-2x mb-2 text-success"></i><br>${fileCount} file(s) selected`;
                    } else {
                        label.innerHTML = `<i class="fas fa-check-circle fa-2x mb-2 text-success"></i><br>File selected: ${this.files[0].name}`;
                    }
                    label.style.background = '#d4edda';
                    label.style.borderColor = '#28a745';
                }
            });
        });

        // Price formatting
        const priceInput = document.querySelector('input[name="total_price"]');
        if (priceInput) {
            priceInput.addEventListener('input', function() {
                // Add thousand separators for display
                const value = parseFloat(this.value);
                if (!isNaN(value)) {
                    // You could add formatting logic here
                }
            });
        }

        // Form validation enhancements
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Add any custom validation here
                const requiredFields = form.querySelectorAll('[required]');
                let hasErrors = false;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#dc3545';
                        hasErrors = true;
                    } else {
                        field.style.borderColor = '#28a745';
                    }
                });
                
                if (hasErrors) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        }
    });
</script>
@endpush