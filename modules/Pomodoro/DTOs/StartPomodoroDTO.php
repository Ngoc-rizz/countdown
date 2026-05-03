<?php

namespace Modules\Pomodoro\DTOs;

use Illuminate\Support\Facades\Auth;

class StartPomodoroDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $type,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            userId: Auth::id(),
            type: $validated['type'],
        );
    }
}
