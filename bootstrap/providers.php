<?php

use Modules\Auth\Providers\AuthServiceProvider;
use Modules\Settings\Providers\SettingsServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    AuthServiceProvider::class,
    SettingsServiceProvider::class,
];
