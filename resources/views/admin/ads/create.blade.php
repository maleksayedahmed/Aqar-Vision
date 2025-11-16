@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">@lang('admin.ads.create_new_ad')</h3></div>
                {{-- Point the form to the store route --}}
                <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Include the form partial, passing a new Ad model --}}
                    @include('admin.ads._form', ['ad' => new \App\Models\Ad()])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection