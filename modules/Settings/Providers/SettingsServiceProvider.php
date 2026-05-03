<?php

namespace Modules\Settings\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Settings\Services\SettingsService;
use App\Modules\Settings\Services\Contracts\SettingsServiceInterface;
use Illuminate\Support\Facades\Route;

class SettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SettingsServiceInterface::class, SettingsService::class);
    }

    public function boot()
    {
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        if (file_exists($webPath = base_path('modules/Settings/Routes/web.php'))) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath = base_path('modules/Settings/Routes/api.php'))) {
            Route::middleware('web')->group($apiPath);
        }
    }
}
