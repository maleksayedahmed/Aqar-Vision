@extends('agency.layouts.app')

@section('agency-content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Ad</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('agency.ads.update', $ad) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $ad->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $ad->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Ad</button>
            <a href="{{ route('agency.ads.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection