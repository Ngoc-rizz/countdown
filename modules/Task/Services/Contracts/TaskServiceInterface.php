<?php

namespace Modules\Task\Services\Contracts;

use App\Models\User;
use Modules\Task\DTOs\StoreTaskDTO;
use Modules\Task\DTOs\UpdateTaskDTO;

interface TaskServiceInterface
{
    public function list(User $user);

    public function create(User $user, StoreTaskDTO $data);

    public function update(User $user, UpdateTaskDTO $data);

    public function delete(User $user, int $id);
}
