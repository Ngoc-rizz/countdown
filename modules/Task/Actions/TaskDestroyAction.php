<?php

namespace Modules\Task\Actions;

use App\Models\User;

class TaskDestroyAction
{
    public function execute(User $user, int $id): bool
    {
        $task = $user->tasks()->find($id);

        if (!$task) {
            return false;
        }

        return $task->delete();
    }
}
