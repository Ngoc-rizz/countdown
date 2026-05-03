<?php

namespace Modules\Pomodoro\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Pomodoro\Services\PomodoroService;
use Modules\Pomodoro\Services\Contracts\PomodoroServiceInterface;
use Illuminate\Support\Facades\Route;

class PomodoroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PomodoroServiceInterface::class, PomodoroService::class);
    }

    public function boot()
    {
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        if (file_exists($webPath = base_path('modules/Pomodoro/Routes/web.php'))) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath = base_path('modules/Pomodoro/Routes/api.php'))) {
            Route::middleware('web')->group($apiPath);
        }
    }
}
