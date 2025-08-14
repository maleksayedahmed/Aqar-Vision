@extends('layouts.app')

@section('title', 'رسائلي')

@section('content')
    @livewire('chat-system', ['conversationId' => request()->query('conversation')])
@endsection