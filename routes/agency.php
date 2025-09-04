<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agency\DashboardController;
use App\Http\Controllers\Agency\ProfileController;
use App\Http\Controllers\Agency\AgentController;
use App\Http\Controllers\Agency\AdController;

// All routes are protected by the 'auth' and new 'is_agency' middleware.
Route::middleware(['auth', 'is_agency'])
    ->prefix('agency')
    ->name('agency.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Agency's own profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Agency's management of its own agents
    Route::resource('agents', AgentController::class);

    // Agency's management of its agents' ads
    Route::resource('ads', AdController::class)->except(['store']); // Agency doesn't create ads directly
});