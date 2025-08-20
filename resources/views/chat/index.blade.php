
@if ($agent['id'])
   <?php $layout = 'layouts.agent'; ?>
    @extends('layouts.agent')
@else
<?php $layout = 'layouts.app'; ?>
@endif

@extends($layout)  


@section('title', 'رسائلي')

@section('content')
    @livewire('chat-system', ['conversationId' => request()->query('conversation')])
@endsection