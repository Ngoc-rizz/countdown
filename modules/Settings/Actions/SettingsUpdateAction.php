<?php

namespace Modules\Settings\Actions;

use App\Models\User;
use Modules\Settings\DTOs\UpdateSettingDTO;

class SettingsUpdateAction
{
    public function execute(User $user, UpdateSettingDTO $dto)
    {
        $pomodoroSeconds = $dto->pomodoro * 60;
        $breakSeconds = $dto->break * 60;

        $user->settings->update([
            'pomodoro_seconds' => $pomodoroSeconds,
            'break_seconds'    => $breakSeconds,
            'auto_check_tasks' => $dto->auto_check,
            'sound_enabled'    => $dto->sound_enabled,
            'theme_color'      => $dto->theme_color,
        ]);

        // 2. Xử lý Pomodoro đang chạy
        $activePomo = $user->pomodoros()
            ->whereIn('status', ['running', 'paused'])
            ->first();

        if ($activePomo) {
            $activePomo->update([
                'scheduled_duration' => $pomodoroSeconds,
                'actual_duration'    => 0,
                'start_time'         => now(),
            ]);
        }

        return $user->settings;
    }
}
