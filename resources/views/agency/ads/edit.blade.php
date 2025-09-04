@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <form action="{{ route('agency.ads.update', $ad) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card-header"><strong>Edit Ad: {{ $ad->title }}</strong></div>
        <div class="card-body">
            <p><strong>Note:</strong> Editing and saving this ad will set its status to "Pending" for re-approval by the site administrator.</p>
            <hr>
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $ad->title) }}" required>
            </div>
             <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $ad->description) }}</textarea>
            </div>
             {{-- Add any other fields from the ad model that an agency should be able to edit --}}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update and Resubmit for Approval</button>
        </div>
    </form>
</div>
@endsection 