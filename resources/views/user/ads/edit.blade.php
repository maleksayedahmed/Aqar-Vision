@extends('layouts.app')

@section('title', __('common.edit_ad') . ': ' . $ad->title)

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@section('content')
<main class="bg-gray-50 px-4 lg:px-20 pt-6 pb-11">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4" role="alert">
            <strong class="font-bold">{{ __('common.please_fix_errors') }}</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.ads.update', $ad) }}">
        @csrf
        @method('PATCH') {{-- Use PATCH method for updates --}}

        @include('user.ads.partials.form-step-one', ['ad' => $ad])

        <div class="flex justify-center mt-12">
            <button type="submit" class="bg-blue-800 text-white font-bold py-3 px-16 rounded-lg hover:bg-blue-700">
                {{ __('common.save_and_submit_for_review') }}
            </button>
        </div>
    </form>
</main>
@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const defaultLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
            const defaultLng = parseFloat(document.getElementById('longitude').value) || 46.6753;
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const map = L.map('map').setView([defaultLat, defaultLng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors' }).addTo(map);
            const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
            marker.on('dragend', function (e) {
                const newPosition = marker.getLatLng();
                latInput.value = newPosition.lat.toFixed(7);
                lngInput.value = newPosition.lng.toFixed(7);
            });

            const citySelect = document.getElementById('city-select');
            const districtSelect = document.getElementById('district-select');
            const selectedDistrictId = "{{ old('district_id', $ad->district_id) }}"; // Use existing ad's district

            function fetchDistricts(cityId, selectedDistrict = null) {
                if (!cityId) {
                    districtSelect.innerHTML = '<option value="">{{ __('common.select_city_first') }}</option>';
                    districtSelect.disabled = true;
                    return;
                }
                fetch(`/get-districts/${cityId}`)
                    .then(response => response.json())
                    .then(districts => {
                        districtSelect.innerHTML = '<option value="">{{ __('common.choose_district') }}</option>';
                        districts.forEach(district => {
                            const option = new Option(district.name, district.id);
                            if (selectedDistrict == district.id) { option.selected = true; }
                            districtSelect.add(option);
                        });
                        districtSelect.disabled = false;
                    });
            }
            citySelect.addEventListener('change', function () { fetchDistricts(this.value); });

            // Initial check on page load for the edit form
            if (citySelect.value) {
                fetchDistricts(citySelect.value, selectedDistrictId);
            }
        });
    </script>
@endpush

