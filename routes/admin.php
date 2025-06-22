<?php

use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AgencyTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\LicenseTypeController;
use App\Http\Controllers\Admin\PropertyAttributeController;
use App\Http\Controllers\Admin\PropertyPurposeController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\Language;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' ,Language::class])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users routes
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('admin.users.toggle-status');

    // Roles routes
    Route::resource('roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy',
    ]);

    // Agency Types routes
    Route::resource('agency-types', AgencyTypeController::class)->names([
        'index' => 'admin.agency-types.index',
        'create' => 'admin.agency-types.create',
        'store' => 'admin.agency-types.store',
        'edit' => 'admin.agency-types.edit',
        'update' => 'admin.agency-types.update',
        'destroy' => 'admin.agency-types.destroy',
    ]);
    Route::post('agency-types/{agencyType}/toggle-status', [AgencyTypeController::class, 'toggleStatus'])
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
    Route::post('agencies/{agency}/update-accreditation-status', [AgencyController::class, 'updateAccreditationStatus'])
        ->name('admin.agencies.update-accreditation-status');

    // License Types routes
    Route::resource('license-types', LicenseTypeController::class)->names([
        'index' => 'admin.license-types.index',
        'create' => 'admin.license-types.create',
        'store' => 'admin.license-types.store',
        'edit' => 'admin.license-types.edit',
        'update' => 'admin.license-types.update',
        'destroy' => 'admin.license-types.destroy',
    ]);
    Route::post('license-types/{licenseType}/toggle-status', [LicenseTypeController::class, 'toggleStatus'])
        ->name('admin.license-types.toggle-status');

    // Licenses routes
    Route::resource('licenses', LicenseController::class)->names([
        'index' => 'admin.licenses.index',
        'create' => 'admin.licenses.create',
        'store' => 'admin.licenses.store',
        'show' => 'admin.licenses.show',
        'edit' => 'admin.licenses.edit',
        'update' => 'admin.licenses.update',
        'destroy' => 'admin.licenses.destroy',
    ]);
    Route::get('licenses/get-agents-by-agency', [LicenseController::class, 'getAgentsByAgency'])
        ->name('admin.licenses.get-agents-by-agency');

    // Property Purposes routes
    Route::resource('property-purposes', PropertyPurposeController::class)->names([
        'index' => 'admin.property-purposes.index',
        'create' => 'admin.property-purposes.create',
        'store' => 'admin.property-purposes.store',
        'edit' => 'admin.property-purposes.edit',
        'update' => 'admin.property-purposes.update',
        'destroy' => 'admin.property-purposes.destroy',
    ]);
    Route::post('property-purposes/{propertyPurpose}/toggle-status', [PropertyPurposeController::class, 'toggleStatus'])
        ->name('admin.property-purposes.toggle-status');

    // Property Types routes
    Route::resource('property-types', PropertyTypeController::class)->names([
        'index' => 'admin.property-types.index',
        'create' => 'admin.property-types.create',
        'store' => 'admin.property-types.store',
        'edit' => 'admin.property-types.edit',
        'update' => 'admin.property-types.update',
        'destroy' => 'admin.property-types.destroy',
    ]);
    Route::post('property-types/{propertyType}/toggle-status', [PropertyTypeController::class, 'toggleStatus'])
        ->name('admin.property-types.toggle-status');

    // Property Attributes routes
    Route::resource('property-attributes', PropertyAttributeController::class)->names([
        'index' => 'admin.property-attributes.index',
        'create' => 'admin.property-attributes.create',
        'store' => 'admin.property-attributes.store',
        'edit' => 'admin.property-attributes.edit',
        'update' => 'admin.property-attributes.update',
        'destroy' => 'admin.property-attributes.destroy',
    ]);

    // Agents routes
    Route::resource('agents', App\Http\Controllers\Admin\AgentController::class)->names([
        'index' => 'admin.agents.index',
        'create' => 'admin.agents.create',
        'store' => 'admin.agents.store',
        'edit' => 'admin.agents.edit',
        'update' => 'admin.agents.update',
        'destroy' => 'admin.agents.destroy',
    ]);

    // Agent Types routes
    Route::resource('agent-types', App\Http\Controllers\Admin\AgentTypeController::class)->names([
        'index' => 'admin.agent-types.index',
        'create' => 'admin.agent-types.create',
        'store' => 'admin.agent-types.store',
        'edit' => 'admin.agent-types.edit',
        'update' => 'admin.agent-types.update',
        'destroy' => 'admin.agent-types.destroy',
    ]);

    // Commercial Records routes
    Route::resource('commercial-records', App\Http\Controllers\Admin\CommercialRecordController::class)->names([
        'index' => 'admin.commercial-records.index',
        'create' => 'admin.commercial-records.create',
        'store' => 'admin.commercial-records.store',
        'edit' => 'admin.commercial-records.edit',
        'update' => 'admin.commercial-records.update',
        'destroy' => 'admin.commercial-records.destroy',
    ]);
});