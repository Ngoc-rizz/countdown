<?php

namespace Modules\Report\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Report\Services\ReportService;
use Modules\Report\Services\Contracts\ReportServiceInterface;

class ReportServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ReportServiceInterface::class, ReportService::class);
    }

    public function boot()
    {
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        if (file_exists($webPath = base_path('modules/Report/Routes/web.php'))) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath = base_path('modules/Report/Routes/api.php'))) {
            Route::middleware('web')->group($apiPath);
        }
    }
}
