@extends('agency.layouts.app')

@section('agency-content')
    <div class="card">
        <form action="{{ route('agency.profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-header">
                <strong>Edit Your Agency Profile</strong>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="agency_name">Agency Name</label>
                    <input type="text" name="agency_name" class="form-control" value="{{ old('agency_name', auth()->user()->agency->agency_name) }}" required>
                </div>
                {{-- Add other agency fields here like email, phone, address etc. --}}
                <div class="form-group mb-3">
                    <label for="email">Contact Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->agency->email) }}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
@endsection