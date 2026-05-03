<?php

namespace Modules\Task\Services;

use App\Models\User;
use Modules\Task\Actions\TaskDestroyAction;
use Modules\Task\Actions\TaskStoreAction;
use Modules\Task\Actions\TaskUpdateAction;
use Modules\Task\DTOs\StoreTaskDTO;
use Modules\Task\DTOs\UpdateTaskDTO;
use Modules\Task\Services\Contracts\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    public function __construct(
        private TaskDestroyAction $destroyAction,
        private TaskStoreAction $createAction,
        private TaskUpdateAction $updateAction
    ) {}
    public function list(User $user)
    {
        return $user->tasks()
            ->orderBy('is_done', 'asc')
            ->orderBy('position', 'asc')
            ->get();
    }

    public function create(User $user, StoreTaskDTO $data)
    {
        return $this->createAction->execute($user, $data);
    }

    public function update(User $user, UpdateTaskDTO $data)
    {
        return $this->updateAction->execute($user, $data);
    }

    public function delete(User $user, int $id)
    {
        return $this->destroyAction->execute($user, $id);
    }
}
