<?php

namespace Modules\Task\Actions;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Task\DTOs\StoreTaskDTO;

class TaskStoreAction
{
    public function execute(User $user, StoreTaskDTO $data): Task
    {
        $maxPosition = $user->tasks()->max('position') ?? 0;

        return DB::transaction(function () use ($user, $data, $maxPosition) {
            return $user->tasks()->create([
                'title' => $data->title,
                'est_pomodoros' => $data->est_pomodoros,
                'note' => $data->note,
                'position' => $maxPosition + 1,
                'act_pomodoros' => 0,
                'is_done' => false,
            ]);
        });
    }
}
