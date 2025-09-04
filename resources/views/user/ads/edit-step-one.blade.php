@extends('layouts.app')

@section('title', 'تعديل الإعلان (الخطوة 1 من 2)')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@section('content')
<main class="bg-gray-50 px-4 lg:px-20 pt-6 pb-11">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4" role="alert">
            <strong class="font-bold">يرجى تصحيح الأخطاء التالية:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- The form now points to the update step 1 route --}}
    @php
    // This variable determines whether to use 'user.ads.' or 'agent.ads.'
    $routePrefix = Auth::user()->agent ? 'agent.ads.' : 'user.ads.';
    @endphp
    <form method="POST" action="{{ route($routePrefix . 'update.step1', $ad) }}">
        @csrf
        @method('PATCH')
        
        {{-- Include the reusable form partial, passing the ad data to it --}}
        @include('user.ads.partials.form-step-one', ['ad' => $ad])

        <div class="flex justify-center mt-12">
            <button type="submit" class="flex items-center justify-center gap-x-2 bg-blue-800 text-white font-bold py-3 px-16 rounded-lg hover:bg-blue-700">
                <span>الخطوة التالية (الوسائط)</span>
                <img src="{{ asset('images/next-arrow.svg') }}">
            </button>
        </div>
    </form>
</main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // This script is now correctly located in the main view file
            const lat = parseFloat(document.getElementById('latitude').value);
            const lng = parseFloat(document.getElementById('longitude').value);
            const map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            const marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function (e) {
                const newPosition = marker.getLatLng();
                document.getElementById('latitude').value = newPosition.lat.toFixed(7);
                document.getElementById('longitude').value = newPosition.lng.toFixed(7);
            });
            
            const citySelect = document.getElementById('city-select');
            const districtSelect = document.getElementById('district-select');
            const selectedDistrictId = "{{ old('district_id', $ad->district_id) }}";

            function fetchDistricts(cityId, selectedDistrict = null) {
                if (!cityId) return;
                fetch(`/get-districts/${cityId}`)
                    .then(response => response.json())
                    .then(districts => {
                        districtSelect.innerHTML = '<option value="">اختر الحي</option>';
                        districts.forEach(district => {
                            const option = new Option(district.name, district.id);
                            if (selectedDistrict == district.id) { option.selected = true; }
                            districtSelect.add(option);
                        });
                        districtSelect.disabled = false;
                    });
            }
            citySelect.addEventListener('change', () => fetchDistricts(citySelect.value));
            if (citySelect.value) {
                fetchDistricts(citySelect.value, selectedDistrictId);
            }
        });
    </script>
@endpush