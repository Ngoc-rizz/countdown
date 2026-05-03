<?php

namespace Modules\Task\Actions;

use App\Models\User;
use Modules\Task\DTOs\UpdateTaskDTO;

class TaskUpdateAction
{
    public function execute(User $user, UpdateTaskDTO $dto)
    {
        $task = $user->tasks()->find($dto->id);
        if (!$task) {
            return null;
        }
        $task->update([
            'title' => $dto->title,
            'est_pomodoros' => $dto->est_pomodoros,
            'act_pomodoros' => $dto->act_pomodoros,
            'is_done' => $dto->is_done,
            'note' => $dto->note,
            'position' => $dto->position,
        ]);
        return $task;
    }
}
