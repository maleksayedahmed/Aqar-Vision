@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('common.notifications') }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($notifications->count() > 0)
                            <div class="list-group">
                                @foreach ($notifications as $notification)
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $notification->data['message'] }}</h6>
                                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                        @if (isset($notification->data['rejection_reason']))
                                            <p class="mb-1 text-danger">{{ __('common.rejection_reason') }}
                                                {{ $notification->data['rejection_reason'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center mb-0">{{ __('common.no_notifications') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
