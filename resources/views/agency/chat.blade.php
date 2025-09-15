@extends('agency.layouts.app')

@section('title', 'Chat')

@section('agency-content')

    {{-- This line loads your Livewire component into the layout --}}
    <livewire:agency.agency-chat-system />

@endsection