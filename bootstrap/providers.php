<?php

use Modules\Auth\Providers\AuthServiceProvider;
use Modules\Settings\Providers\SettingsServiceProvider;
use Modules\Pomodoro\Providers\PomodoroServiceProvider;
use Modules\Report\Providers\ReportServiceProvider;
use Modules\Task\Providers\TaskServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    AuthServiceProvider::class,
    SettingsServiceProvider::class,
    PomodoroServiceProvider::class,
    TaskServiceProvider::class,
    ReportServiceProvider::class,
];
