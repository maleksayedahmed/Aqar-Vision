@extends('agency.layouts.app')

@section('title', __('agency.chat.title'))

@section('agency-content')

    {{-- This line loads your Livewire component into the layout --}}
    <livewire:agency.agency-chat-system />

@endsection