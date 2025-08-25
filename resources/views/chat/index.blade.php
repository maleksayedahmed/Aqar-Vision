@extends($layout)


@section('title', 'رسائلي')

@section('content')
    @livewire('chat-system', ['conversationId' => $conversationId])
@endsection