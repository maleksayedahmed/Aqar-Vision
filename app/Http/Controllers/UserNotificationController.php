<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function index()
    {
        return view('user.notifications.index');
    }
}