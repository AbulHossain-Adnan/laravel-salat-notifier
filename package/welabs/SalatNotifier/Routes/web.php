<?php

use Illuminate\Support\Facades\Route;
use welabs\SalatNotifier\Http\Controllers\SalatTimeController;

// Manage Salat Times Route
Route::middleware('web')->group(function () {
    Route::resource('salat-times', SalatTimeController::class)->except('show');
});