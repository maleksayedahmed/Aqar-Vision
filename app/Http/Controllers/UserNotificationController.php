<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function index()
    {
    // Livewire component handles loading and paginating notifications
    return view('user.notifications.index');
    }
}