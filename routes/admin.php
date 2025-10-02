<?php

use App\Http\Controllers\Admin\AdPriceController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\AgencyTypeController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AgentTypeController;
use App\Http\Controllers\Admin\CommercialRecordController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\LicenseTypeController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PropertyAttributeController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyPurposeController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UpgradeRequestController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Middleware\Language;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth' ,'role:admin', Language::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users & Roles
    Route::resource('users', UserController::class)->except('show');
    Route::get('users/{user}/details', [UserController::class, 'getDetails'])->name('users.details');
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('roles', RoleController::class)->except('show');

    // Agencies & Agents
    Route::resource('agencies', AgencyController::class)->except('show');
    Route::post('agencies/{agency}/update-accreditation-status', [AgencyController::class, 'updateAccreditationStatus'])->name('agencies.update-accreditation-status');
    Route::resource('agency-types', AgencyTypeController::class)->except('show');
    Route::post('agency-types/{agencyType}/toggle-status', [AgencyTypeController::class, 'toggleStatus'])->name('agency-types.toggle-status');
    Route::resource('agents', AgentController::class)->except('show');
    Route::resource('agent-types', AgentTypeController::class)->except('show');

    // Licensing
    Route::resource('licenses', LicenseController::class);
    Route::get('licenses/get-agents-by-agency', [LicenseController::class, 'getAgentsByAgency'])->name('licenses.get-agents-by-agency');
    Route::resource('license-types', LicenseTypeController::class)->except('show');
    Route::post('license-types/{licenseType}/toggle-status', [LicenseTypeController::class, 'toggleStatus'])->name('license-types.toggle-status');

    // Properties
    Route::resource('properties', PropertyController::class);
    Route::get('properties/{property}/media/{media}/destroy', [PropertyController::class, 'destroyMedia'])->name('properties.media.destroy');
    Route::resource('property-types', PropertyTypeController::class)->except('show');
    Route::post('property-types/{propertyType}/toggle-status', [PropertyTypeController::class, 'toggleStatus'])->name('property-types.toggle-status');
    Route::get('property-types/{propertyType}/attributes', [PropertyTypeController::class, 'getAttributes'])->name('property-types.attributes');
    Route::resource('property-purposes', PropertyPurposeController::class)->except('show');
    Route::post('property-purposes/{propertyPurpose}/toggle-status', [PropertyPurposeController::class, 'toggleStatus'])->name('property-purposes.toggle-status');
    Route::resource('property-attributes', PropertyAttributeController::class)->except('show');

    Route::resource('ads', AdController::class);
    Route::post('ads/{ad}/approve', [AdController::class, 'approve'])->name('ads.approve');
    Route::post('ads/{ad}/reject', [AdController::class, 'reject'])->name('ads.reject');

    // Locations (Districts & Cities)
    Route::resource('districts', DistrictController::class)->except('show');
    Route::resource('cities', CityController::class)->except('show');

    // Monetization
    Route::resource('plans', PlanController::class)->except('show');
    Route::resource('subscriptions', SubscriptionController::class)->except('show');
    Route::resource('ad-prices', AdPriceController::class)->except('show');

    // Other Records
    Route::resource('commercial-records', CommercialRecordController::class)->except('show');

    Route::get('upgrade-requests', [UpgradeRequestController::class, 'index'])->name('upgrade-requests.index');
    Route::get('upgrade-requests/{upgradeRequest}', [UpgradeRequestController::class, 'show'])->name('upgrade-requests.show');
    Route::post('upgrade-requests/{upgradeRequest}/approve', [UpgradeRequestController::class, 'approve'])->name('upgrade-requests.approve');
    Route::post('upgrade-requests/{upgradeRequest}/reject', [UpgradeRequestController::class, 'reject'])->name('upgrade-requests.reject');
});
