<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadImportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/leads/upload', [LeadImportController::class, 'create'])->name('leads.upload.form');
    Route::post('/leads/upload', [LeadImportController::class, 'store'])->name('leads.upload');
});
