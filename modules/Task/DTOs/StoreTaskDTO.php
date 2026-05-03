<?php

namespace Modules\Task\DTOs;

class StoreTaskDTO
{
    public function __construct(
        public readonly string $title,
        public readonly int $est_pomodoros,
        public readonly ?string $note
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['title'],
            $data['est_pomodoros'],
            $data['note'] ?? null
        );
    }
}
