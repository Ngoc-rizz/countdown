<?php

namespace Modules\Settings\Actions;

use App\Models\User;
use Modules\Settings\DTOs\UpdateSettingDTO;

class SettingsUpdateAction
{
    public function execute(User $user, UpdateSettingDTO $dto)
    {
        return  $user->settings->update([
            'pomodoro_minutes' => $dto->pomodoro,
            'break_minutes' => $dto->break,
            'auto_check_tasks' => $dto->auto_check,
            'sound_enabled' => $dto->sound_enabled,
            'theme_color' => $dto->theme_color,
        ]);
    }
}
