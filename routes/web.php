<?php

use Illuminate\Support\Facades\Route;

// General Controllers
use App\Http\Controllers\HomeController as UserHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserRequestController;

// Auth Controllers (including the new one)
use App\Http\Controllers\Auth\LoginWithPhoneController;

// Agent Controllers
use App\Http\Controllers\Agent\HomeController;
use App\Http\Controllers\Agent\PackageController;
use App\Http\Controllers\Agent\ContactController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;
use App\Http\Controllers\Agent\AdController;
use App\Http\Controllers\Agent\AboutController;
use App\Http\Controllers\Agent\ComplaintController;
use App\Http\Controllers\Agent\TermsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PropertySearchController;
use App\Http\Controllers\Agent\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage Route
Route::get('/', [UserHomeController::class, 'index'])->name('home');

Route::post('/login/phone', [LoginWithPhoneController::class, 'sendOtp'])->name('login.phone.send');
Route::post('/login/otp/verify', [LoginWithPhoneController::class, 'verifyOtp'])->name('login.phone.verify');
Route::get('/get-districts/{city}', [LocationController::class, 'getDistrictsByCity'])->name('districts.get');
Route::get('/properties', [PropertySearchController::class, 'index'])->name('properties.search');
Route::get('/properties/map', [PropertySearchController::class, 'map'])->name('properties.map');
Route::get('/properties/{ad}', [PropertySearchController::class, 'show'])->name('properties.show');
Route::get('/agents/{agent}', [PropertySearchController::class, 'showAgent'])->name('agents.show');
  Route::get('/about-us', [App\Http\Controllers\AboutController::class, 'index'])->name('user.about-us');


Route::prefix('my-account/ads')->name('user.ads.')->group(function () {
    Route::get('/create', [App\Http\Controllers\UserAdController::class, 'create'])->name('create');
    Route::get('/create/step-1/{adPrice}', [App\Http\Controllers\UserAdController::class, 'createStepOne'])->name('create.step1');
    Route::post('/create/step-1', [App\Http\Controllers\UserAdController::class, 'storeStepOne'])->name('store.step1');
    Route::get('/create/step-2', [App\Http\Controllers\UserAdController::class, 'createStepTwo'])->name('create.step2');
    Route::post('/create/store', [App\Http\Controllers\UserAdController::class, 'storeAd'])->name('store');
});



 


Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/upgrade-request', [UserRequestController::class, 'store'])->name('user.upgrade.request');

     // CHAT ROUTES
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.show');
    Route::get('/chat/start/{ad}', [App\Http\Controllers\ChatController::class, 'startChat'])->name('chat.start');
    Route::get('/chat/start/user/{user}', [App\Http\Controllers\ChatController::class, 'startChatWithUser'])->name('chat.start.user');




     // ======================================================= //
    // ADD THE NEW USER ROUTES HERE
    // ======================================================= //

 Route::get('/my-profile', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('user.profile.edit');
 Route::patch('/my-profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('user.profile.update');
 Route::get('/my-ads', [App\Http\Controllers\UserAdsController::class, 'index'])->name('user.my-ads');
 Route::get('/terms-of-use', [App\Http\Controllers\TermsController::class, 'index'])->name('user.terms');
     Route::get('/complaints', [App\Http\Controllers\ComplaintController::class, 'create'])->name('user.complaints.create');
    Route::post('/complaints', [App\Http\Controllers\ComplaintController::class, 'store'])->name('user.complaints.store');


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
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

});