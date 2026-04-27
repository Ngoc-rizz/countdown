<?php

namespace Modules\Auth\Providers;

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
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }
}
