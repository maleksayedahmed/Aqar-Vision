<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upgrade-request', [UserRequestController::class, 'store'])->name('user.upgrade.request');
});

Route::middleware(['web'])->group(function () {
    Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';



// ===================================
// AGENT ROUTES
// ===================================
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {

    // This route handles the URL: /agent
    // It's the agent's "home page".
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Other agent-specific routes will go here later
    // e.g., Route::get('/profile', ...)->name('profile');
    // e.g., Route::get('/listings', ...)->name('listings.index');

});
