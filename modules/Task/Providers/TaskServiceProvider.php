<?php

namespace Modules\Task\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Task\Services\TaskService;
use Modules\Task\Services\Contracts\TaskServiceInterface;

class TaskServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
    }

    public function boot()
    {
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        if (file_exists($webPath = base_path('modules/Task/Routes/web.php'))) {
            Route::middleware('web')->group($webPath);
        }

        if (file_exists($apiPath = base_path('modules/Task/Routes/api.php'))) {
            Route::middleware('web')->group($apiPath);
        }
    }
}
