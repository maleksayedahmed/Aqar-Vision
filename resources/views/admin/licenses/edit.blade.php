@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.licenses.edit') }}</h3>
                    </div>
                    <form action="{{ route('admin.licenses.update', $license->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_type_id">{{ __('attributes.licenses.license_type') }} *</label>
                                        <select class="form-control @error('license_type_id') is-invalid @enderror"
                                            id="license_type_id" name="license_type_id" required>
                                            <option value="">{{ __('attributes.licenses.select_license_type') }}
                                            </option>
                                            @foreach ($licenseTypes as $licenseType)
                                                <option value="{{ $licenseType->id }}"
                                                    {{ old('license_type_id', $license->license_type_id) == $licenseType->id ? 'selected' : '' }}>
                                                    {{ $licenseType->getTranslation('name', app()->getLocale()) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('license_type_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_number">{{ __('attributes.licenses.license_number') }} *</label>
                                        <input type="text"
                                            class="form-control @error('license_number') is-invalid @enderror"
                                            id="license_number" name="license_number"
                                            value="{{ old('license_number', $license->license_number) }}" required>
                                        @error('license_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="issuer">{{ __('attributes.licenses.issuer') }}</label>
                                        <input type="text" class="form-control @error('issuer') is-invalid @enderror"
                                            id="issuer" name="issuer" value="{{ old('issuer', $license->issuer) }}">
                                        @error('issuer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agency_id">{{ __('attributes.licenses.agency') }}</label>
                                        <select class="form-control @error('agency_id') is-invalid @enderror" id="agency_id"
                                            name="agency_id">
                                            <option value="">{{ __('attributes.licenses.select_agency') }}</option>
                                            @foreach ($agencies as $agency)
                                                <option value="{{ $agency->id }}"
                                                    {{ old('agency_id', $license->agency_id) == $agency->id ? 'selected' : '' }}>
                                                    {{ $agency->getTranslation('agency_name', app()->getLocale()) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('agency_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agent_id">{{ __('attributes.licenses.agent') }}</label>
                                        <select class="form-control @error('agent_id') is-invalid @enderror" id="agent_id"
                                            name="agent_id">
                                            <option value="">{{ __('attributes.licenses.select_agent') }}</option>
                                            @if ($license->agent)
                                                <option value="{{ $license->agent->id }}" selected>
                                                    {{ $license->agent->full_name }}
                                                </option>
                                            @endif
                                        </select>
                                        @error('agent_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="issue_date">{{ __('attributes.licenses.issue_date') }}</label>
                                        <input type="date" class="form-control @error('issue_date') is-invalid @enderror"
                                            id="issue_date" name="issue_date"
                                            value="{{ old('issue_date', $license->issue_date ? $license->issue_date->format('Y-m-d') : '') }}">
                                        @error('issue_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expiry_date">{{ __('attributes.licenses.expiry_date') }}</label>
                                        <input type="date"
                                            class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date"
                                            name="expiry_date"
                                            value="{{ old('expiry_date', $license->expiry_date ? $license->expiry_date->format('Y-m-d') : '') }}">
                                        @error('expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('attributes.messages.save') }}</button>
                            <a href="{{ route('admin.licenses.index') }}"
                                class="btn btn-default">{{ __('attributes.messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#agency_id').change(function() {
                    var agencyId = $(this).val();
                    var agentSelect = $('#agent_id');
                    var currentAgentId = '{{ $license->agent_id }}';

                    agentSelect.empty();
                    agentSelect.append(
                        '<option value="">{{ __('attributes.licenses.select_agent') }}</option>');

                    if (agencyId) {
                        $.ajax({
                            url: '{{ route('admin.licenses.get-agents-by-agency') }}',
                            type: 'GET',
                            data: {
                                agency_id: agencyId
                            },
                            success: function(data) {
                                $.each(data, function(key, agent) {
                                    var selected = agent.id == currentAgentId ? 'selected' :
                                        '';
                                    agentSelect.append('<option value="' + agent.id + '" ' +
                                        selected + '>' + agent.full_name + '</option>');
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
