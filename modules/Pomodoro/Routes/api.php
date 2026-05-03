<?php

use Illuminate\Support\Facades\Route;
use Modules\Pomodoro\Controllers\PomodoroController;

Route::redirect('/', '/pomodoro');
Route::get('/pomodoro', [PomodoroController::class, 'index'])->name('pomodoro');

Route::middleware(['auth', 'verified'])->prefix('pomodoro')->group(function () {
    Route::post('/start', [PomodoroController::class, 'start'])->name('pomodoro.start');
    Route::post('/pause', [PomodoroController::class, 'pause'])->name('pomodoro.pause');
    Route::post('/finish', [PomodoroController::class, 'finish'])->name('pomodoro.finish');
});
