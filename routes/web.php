<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\HomeController;
use App\Http\Controllers\Agent\PackageController;
use App\Http\Controllers\Agent\ContactController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;
use App\Http\Controllers\Agent\AdController;
use App\Http\Controllers\Agent\AboutController;
use App\Http\Controllers\Agent\ComplaintController;
use App\Http\Controllers\Agent\TermsController;
use App\Http\Controllers\HomeController as UserHomeController;


Route::get('/', [UserHomeController::class, 'index'])->name('home');

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



Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages');
    Route::get('/contact', [ContactController::class, 'create'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::get('/profile', [AgentProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AgentProfileController::class, 'update'])->name('profile.update');
    Route::get('/my-ads', [AdController::class, 'index'])->name('my-ads');
    Route::get('/about-us', [AboutController::class, 'index'])->name('about-us');
    Route::get('/complaints', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/terms-of-use', [TermsController::class, 'index'])->name('terms-of-use');

    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');

    Route::get('/ads/create/step-1/{adPrice}', [AdController::class, 'createStepOne'])->name('ads.create.step1');
    Route::post('/ads/create/step-1', [AdController::class, 'storeStepOne'])->name('ads.store.step1');

    Route::get('/ads/create/step-2', [AdController::class, 'createStepTwo'])->name('ads.create.step2');
    Route::post('/ads/create/store', [AdController::class, 'storeAd'])->name('ads.store');


});
