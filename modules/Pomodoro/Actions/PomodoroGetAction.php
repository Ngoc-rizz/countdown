<?php

namespace Modules\Pomodoro\Actions;

use App\Models\Pomodoro;
use App\Models\User;

class PomodoroGetAction
{
    public function execute(?User $user)
    {
        $pomodoroData = [
            'pomodoro' => 25 * 60,
            'breakTime' => 5 * 60,
            'status' => 'idle',
            'taskId' => null,
        ];
        if (!$user) {
            return $pomodoroData;
        }
        $settings = $user->settings;
        $pomodoroData['pomodoro'] = $settings['pomodoro_seconds'];
        $pomodoroData['breakTime'] = $settings['break_seconds'];
        $pomodoroData['timeLeft'] = $settings['pomodoro_seconds'];

        $currentSession = Pomodoro::where('user_id', $user->id)
            ->whereIn('status', ['running', 'paused'])
            ->latest()
            ->first();


        if ($currentSession) {
            $pomodoroData['pomodoro'] = $currentSession->scheduled_duration;
            $pomodoroData['status'] = $currentSession->status;

            // Tính toán thời gian còn lại (Time Left)
            if ($currentSession->status === 'paused') {
                $pomodoroData['timeLeft'] = (int) ($currentSession->scheduled_duration - $currentSession->actual_duration);
            } else {
                $now = now()->timestamp;
                $start = $currentSession->start_time->timestamp;

                // Tính số giây thực tế đã trôi qua
                $elapsed = $now - $start;

                // timeLeft = Tổng cài đặt - Đã trôi qua
                $timeLeft = $currentSession->scheduled_duration - $elapsed;

                $pomodoroData['timeLeft'] = (int) max(0, $timeLeft);
            }
        }
        return $pomodoroData;
    }
}
