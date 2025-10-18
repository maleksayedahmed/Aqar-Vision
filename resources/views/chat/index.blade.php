@extends($layout)


@section('title', __('common.my_messages'))

@section('content')
    @livewire('chat-system', ['conversationId' => $conversationId])
@endsection
