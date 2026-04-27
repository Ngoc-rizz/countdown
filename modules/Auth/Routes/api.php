<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthenticatedSessionController;
use Modules\Auth\Controllers\ConfirmablePasswordController;
use Modules\Auth\Controllers\EmailVerificationNotificationController;
use Modules\Auth\Controllers\EmailVerificationPromptController;
use Modules\Auth\Controllers\PasswordController;
use Modules\Auth\Controllers\ProfileController;
use Modules\Auth\Controllers\VerifyEmailController;
use Modules\Settings\Controllers\SettingController;

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::middleware('verified')->group(function () {

        Route::get('/reports', function () {
            return view('pages.report');
        })->name('reports');

        Route::get('/settings', [SettingController::class, 'show'])->name('settings');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    });
});
