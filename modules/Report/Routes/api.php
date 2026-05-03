<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Controllers\ReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/reports', [ReportController::class, 'getReportData'])->name('reports');
});
