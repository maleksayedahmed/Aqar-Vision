@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Real Estate</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.real-estate.update', $realEstate->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Add your form fields here -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin/css/real-estate.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('admin/js/real-estate.js') }}"></script>
@endpush
