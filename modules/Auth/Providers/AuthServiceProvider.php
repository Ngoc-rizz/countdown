<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Modules\Auth\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Services\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    public function boot()
    {
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        if (file_exists($webPath = base_path('modules/Auth/Routes/web.php'))) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath = base_path('modules/Auth/Routes/api.php'))) {
            Route::middleware('web')->group($apiPath);
        }
    }
}
