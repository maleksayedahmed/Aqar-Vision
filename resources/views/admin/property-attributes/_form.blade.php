<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_en">{{ __('attributes.property_attributes.name_en') }}</label>
                <input type="text" class="form-control @error('name.en') is-invalid @enderror" id="name_en" name="name[en]" value="{{ old('name.en', $propertyAttribute?->getTranslation('name', 'en')) }}" required>
                @error('name.en')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_ar">{{ __('attributes.property_attributes.name_ar') }}</label>
                <input type="text" class="form-control @error('name.ar') is-invalid @enderror" id="name_ar" name="name[ar]" value="{{ old('name.ar', $propertyAttribute?->getTranslation('name', 'ar')) }}" required>
                @error('name.ar')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="type">{{ __('attributes.property_attributes.type') }}</label>
                <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required>
                    <option value="text" {{ old('type', $propertyAttribute?->type) == 'text' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.text') }}</option>
                    <option value="number" {{ old('type', $propertyAttribute?->type) == 'number' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.number') }}</option>
                    <option value="boolean" {{ old('type', $propertyAttribute?->type) == 'boolean' ? 'selected' : '' }}>{{ __('attributes.property_attributes.types.boolean') }}</option>
                    {{-- ADDED: Dropdown option --}}
                    <option value="dropdown" {{ old('type', $propertyAttribute?->type) == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon">Icon (Optional, preferably SVG/PNG)</label>
                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" id="icon">
                @error('icon')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
    </div>

    @if ($propertyAttribute?->icon_path)
        <div class="form-group mt-3">
            <label>Current Icon:</label>
            <div>
                <img src="{{ Storage::url($propertyAttribute->icon_path) }}" alt="Icon" style="width: 50px; height: 50px; background: #f0f0f0; padding: 5px; border-radius: 5px; object-fit: contain;">
            </div>
        </div>
    @endif

    {{-- START: New section for managing dropdown choices --}}
    <div id="choices-container" style="display: none;">
        <hr class="my-4">
        <h5>Dropdown Choices</h5>
        <div id="choices-wrapper">
            {{-- Loop through existing choices if editing --}}
            @if(old('choices') || $propertyAttribute?->choices)
                @foreach(old('choices', $propertyAttribute?->choices ?? []) as $index => $choice)
                    <div class="row align-items-center choice-row mb-2">
                        <div class="col-md-5">
                            <input type="text" name="choices[{{ $index }}][en]" class="form-control" placeholder="Choice (English)" value="{{ $choice['en'] ?? '' }}">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="choices[{{ $index }}][ar]" class="form-control" placeholder="Choice (Arabic)" value="{{ $choice['ar'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-choice-btn">Remove</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" id="add-choice-btn" class="btn btn-success btn-sm mt-2">Add Choice</button>
    </div>
    {{-- END: New section --}}
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
    <a href="{{ route('admin.property-attributes.index') }}" class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const choicesContainer = document.getElementById('choices-container');
    const addChoiceBtn = document.getElementById('add-choice-btn');
    const choicesWrapper = document.getElementById('choices-wrapper');
    let choiceIndex = {{ count(old('choices', $propertyAttribute?->choices ?? [])) }};

    function toggleChoicesVisibility() {
        if (typeSelect.value === 'dropdown') {
            choicesContainer.style.display = 'block';
        } else {
            choicesContainer.style.display = 'none';
        }
    }

    addChoiceBtn.addEventListener('click', function () {
        const newRow = document.createElement('div');
        newRow.className = 'row align-items-center choice-row mb-2';
        newRow.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="choices[${choiceIndex}][en]" class="form-control" placeholder="Choice (English)" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="choices[${choiceIndex}][ar]" class="form-control" placeholder="Choice (Arabic)" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-choice-btn">Remove</button>
            </div>
        `;
        choicesWrapper.appendChild(newRow);
        choiceIndex++;
    });

    choicesWrapper.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-choice-btn')) {
            e.target.closest('.choice-row').remove();
        }
    });

    typeSelect.addEventListener('change', toggleChoicesVisibility);
    toggleChoicesVisibility(); // Initial check on page load
});
</script>
@endpush