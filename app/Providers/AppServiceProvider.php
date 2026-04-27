<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('components.navigation', function ($view) {
            $view->with('navItems', [
                [
                    'name' => 'Pomodoro',
                    'route' => 'pomodoro',
                    'icon' => 'clock',
                ],
                [
                    'name' => 'Reports',
                    'route' => 'reports',
                    'icon' => 'chart-column-increasing',
                ],
                [
                    'name' => 'Settings',
                    'route' => 'settings',
                    'icon' => 'settings',
                ],

            ]);
        });
    }
}
