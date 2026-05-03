<?php

use Illuminate\Support\Facades\Route;
use Modules\Task\Controllers\TaskController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('task.reorder');
});
