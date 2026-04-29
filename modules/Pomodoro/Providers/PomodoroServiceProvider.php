<?php

namespace App\Modules\Pomodoro\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Pomodoro\Services\PomodoroService;
use App\Modules\Pomodoro\Services\Contracts\PomodoroServiceInterface;

class PomodoroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PomodoroServiceInterface::class, PomodoroService::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }
}