<div class="card-body">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $property?->title) }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $property?->description) }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="property_type_id">Property Type</label>
                <select name="property_type_id" id="property_type_id" class="form-control" required>
                    <option value="">Select a Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-attributes-url="{{ route('admin.property-types.attributes', $type->id) }}"
                            {{ old('property_type_id', $property?->property_type_id) == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="purpose_id">Property Purpose</label>
                <select name="purpose_id" class="form-control" required>
                    @foreach ($purposes as $purpose)
                        <option value="{{ $purpose->id }}" {{ old('purpose_id', $property?->purpose_id) == $purpose->id ? 'selected' : '' }}>{{ $purpose->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price', $property?->total_price) }}" required>
            </div>
        </div>
    </div>

    <hr>
    <h5>Dynamic Attributes</h5>
    <div id="dynamic-attributes-container" class="row">
        <p class="text-muted">Please select a property type to see its specific attributes.</p>
    </div>
    <hr>


</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Save Property</button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const propertyTypeSelect = document.getElementById('property_type_id');
        const attributesContainer = document.getElementById('dynamic-attributes-container');
        const propertyData = @json($property?->services ?? new stdClass());

        function fetchAndRenderAttributes(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const url = selectedOption.dataset.attributesUrl;

            if (!url) {
                attributesContainer.innerHTML = '<p class="text-muted">Please select a property type to see its specific attributes.</p>';
                return;
            }

            attributesContainer.innerHTML = '<p>Loading attributes...</p>';

            fetch(url)
                .then(response => response.json())
                .then(attributes => {
                    attributesContainer.innerHTML = '';
                    if (attributes.length === 0) {
                        attributesContainer.innerHTML = '<p class="text-muted">This property type has no specific attributes.</p>';
                        return;
                    }

                    attributes.forEach(attribute => {
                        const col = document.createElement('div');
                        col.className = 'col-md-4';

                        const formGroup = document.createElement('div');
                        formGroup.className = 'form-group';

                        const label = document.createElement('label');
                        label.htmlFor = `attribute_${attribute.id}`;
                        label.textContent = attribute.name['{{ app()->getLocale() }}'];

                        let input;
                        const attributeName = `attributes[${attribute.name.en.toLowerCase().replace(/ /g, '_')}]`;
                        const existingValue = propertyData[attribute.name.en.toLowerCase().replace(/ /g, '_')] || '';

                        if (attribute.type === 'boolean') {
                            input = document.createElement('select');
                            input.className = 'form-control';
                            const optionYes = new Option('Yes', '1', false, existingValue == '1');
                            const optionNo = new Option('No', '0', false, existingValue == '0');
                            input.add(new Option('Select...', ''));
                            input.add(optionYes);
                            input.add(optionNo);
                        } else {
                            input = document.createElement('input');
                            input.type = attribute.type;
                            input.className = 'form-control';
                            input.value = existingValue;
                        }

                        input.id = `attribute_${attribute.id}`;
                        input.name = attributeName;

                        formGroup.appendChild(label);
                        formGroup.appendChild(input);
                        col.appendChild(formGroup);
                        attributesContainer.appendChild(col);
                    });
                });
        }

        propertyTypeSelect.addEventListener('change', function () {
            fetchAndRenderAttributes(this);
        });

        if (propertyTypeSelect.value) {
            fetchAndRenderAttributes(propertyTypeSelect);
        }
    });
</script>
@endpush
