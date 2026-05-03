<?php

namespace Modules\Task\DTOs;

class UpdateTaskDTO
{
    public function __construct(
        public readonly int|string $id,
        public readonly ?string $title,
        public readonly ?int $est_pomodoros,
        public readonly ?int $act_pomodoros,
        public readonly ?bool $is_done,
        public readonly ?string $note,
        public readonly ?int $position
    ) {}

    public static function fromRequest(int|string $id, array $data): self
    {
        return new self(
            id: $id,
            title: $data['title'] ?? null,
            est_pomodoros: $data['est_pomodoros'] ?? null,
            act_pomodoros: $data['act_pomodoros'] ?? null,
            is_done: $data['is_done'] ?? false,
            note: $data['note'] ?? null,
            position: $data['position'] ?? 0
        );
    }
}
