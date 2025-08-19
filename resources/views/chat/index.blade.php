
@if ($agent['id'])
    @extends('layouts.agent')
@else
    @extends('layouts.app')
@endif


@section('title', 'رسائلي')

@section('content')
    @livewire('chat-system', ['conversationId' => request()->query('conversation')])
@endsection