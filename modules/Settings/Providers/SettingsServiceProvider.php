<?php

namespace App\Modules\Settings\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Settings\Services\SettingsService;
use App\Modules\Settings\Services\Contracts\SettingsServiceInterface;

class SettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SettingsServiceInterface::class, SettingsService::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }
}