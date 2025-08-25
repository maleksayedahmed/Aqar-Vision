    @extends('admin.layouts.app')
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Create New City</h3></div>
                    <form action="{{ route('admin.cities.store') }}" method="POST">
                        @csrf
                        @include('admin.cities._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection