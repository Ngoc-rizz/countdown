<?php

namespace Modules\Pomodoro\DTOs;

use Illuminate\Support\Facades\Auth;

class PausePomodoroDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $type,
        public readonly int $timeLeft,
        public readonly ?int $taskId,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            userId: Auth::id(),
            type: $validated['type'],
            timeLeft: $validated['timeLeft'],
            taskId: $validated['taskId'],
        );
    }
}
