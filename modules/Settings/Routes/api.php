<?php

namespace Modules\Settings\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Settings\Controllers\SettingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/settings', [SettingController::class, 'show'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
