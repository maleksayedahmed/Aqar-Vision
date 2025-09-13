<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agency\DashboardController;
use App\Http\Controllers\Agency\ProfileController;
use App\Http\Controllers\Agency\AgentController;
use App\Http\Controllers\Agency\AdController;
use App\Http\Controllers\Agency\PropertyController;
use App\Http\Middleware\Language;


// All routes are protected by the 'auth' and new 'is_agency' middleware.
Route::middleware(['auth',Language::class, 'is_agency'])
    ->prefix('agency')
    ->name('agency.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Agency's own profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Agency's notifications
    Route::get('/notifications', [\App\Http\Controllers\Agency\NotificationController::class, 'index'])->name('notifications');

    // Agency's management of its own agents
    Route::get('agents/invite', [AgentController::class, 'showInviteForm'])->name('agents.invite');
    Route::post('agents/invite', [AgentController::class, 'sendInvitation'])->name('agents.sendInvitation');
    Route::delete('agents/invitation/{invitation}/cancel', [AgentController::class, 'cancelInvitation'])->name('agents.cancelInvitation');
    Route::delete('agents/{agent}/remove', [AgentController::class, 'removeFromAgency'])->name('agents.removeFromAgency');
    Route::resource('agents', AgentController::class);

    // Agency's management of its agents' ads
    Route::resource('ads', AdController::class)->except(['store']); // Agency doesn't create ads directly
    Route::resource('properties', PropertyController::class);
});