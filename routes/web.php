<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeadImportController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /* Profile */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /* Leads – Upload */
    Route::get('/leads/upload', [LeadImportController::class, 'create'])
        ->name('leads.upload.form');
    Route::post('/leads/upload', [LeadImportController::class, 'store'])
        ->name('leads.upload');

    /* Leads – List & Filters */
    Route::get('/leads', [LeadController::class, 'index'])
        ->name('leads.index');

    /* Leads – Export to Excel (STEP 4) */
    Route::get('/leads/export', [LeadController::class, 'export'])
        ->name('leads.export');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login / Logout)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
