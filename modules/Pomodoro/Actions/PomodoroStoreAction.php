<?php

namespace Modules\Pomodoro\Actions;

use App\Models\Pomodoro;
use Illuminate\Support\Facades\Auth;
use Modules\Pomodoro\DTOs\StartPomodoroDTO;

class PomodoroStoreAction
{
    public function execute(StartPomodoroDTO $dto)
    {
        if ($dto->type !== 'pomodoro') {
            return null;
        }

        // 1. Tìm xem có phiên nào đang dang dở (running hoặc paused) không
        $existingSession = Pomodoro::where('user_id', $dto->userId)
            ->whereIn('status', ['running', 'paused'])
            ->latest()
            ->first();

        // 2. Nếu đã có phiên đang chạy (running), thì không làm gì cả để tránh trùng lặp
        if ($existingSession && $existingSession->status === 'running') {
            return $existingSession;
        }

        // 3. Nếu phiên đang ở trạng thái tạm dừng (paused) -> RESUME
        if ($existingSession && $existingSession->status === 'paused') {
            $existingSession->update([
                'status' => 'running',
                'start_time' => now()->subSeconds($existingSession->actual_duration), // Quan trọng: Cập nhật lại start_time
            ]);

            return $existingSession;
        }

        // 4. Nếu không có phiên nào -> TẠO MỚI (Logic cũ của bạn)
        $settings = Auth::user()->settings;
        $scheduledSeconds = $settings->pomodoro_seconds;

        return Pomodoro::create([
            'user_id' => $dto->userId,
            'type' => 'pomodoro',
            'start_time' => now(),
            'scheduled_duration' => $scheduledSeconds,
            'actual_duration' => 0,
            'status' => 'running',
        ]);
    }
}
