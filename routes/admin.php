<?php

use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AgencyTypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Users routes
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::post('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('admin.users.toggle-status');

    // Agency Types routes
    Route::resource('agency-types', AgencyTypeController::class)->names([
        'index' => 'admin.agency-types.index',
        'create' => 'admin.agency-types.create',
        'store' => 'admin.agency-types.store',
        'edit' => 'admin.agency-types.edit',
        'update' => 'admin.agency-types.update',
        'destroy' => 'admin.agency-types.destroy',
    ]);
    Route::post('agency-types/{id}/toggle-status', [AgencyTypeController::class, 'toggleStatus'])
        ->name('admin.agency-types.toggle-status');

    // Agencies routes
    Route::resource('agencies', AgencyController::class)->names([
        'index' => 'admin.agencies.index',
        'create' => 'admin.agencies.create',
        'store' => 'admin.agencies.store',
        'edit' => 'admin.agencies.edit',
        'update' => 'admin.agencies.update',
        'destroy' => 'admin.agencies.destroy',
    ]);
    Route::post('agencies/{id}/update-accreditation-status', [AgencyController::class, 'updateAccreditationStatus'])
        ->name('admin.agencies.update-accreditation-status');
}); 