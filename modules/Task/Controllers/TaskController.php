<?php

namespace Modules\Task\Controllers;

use App\Http\Controllers\Controller;
use Modules\Task\Requests\StoreTaskRequest;
use Modules\Task\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Task\DTOs\StoreTaskDTO;
use Modules\Task\DTOs\UpdateTaskDTO;
use Modules\Task\Services\Contracts\TaskServiceInterface;

class TaskController extends Controller
{
    public function __construct(
        private TaskServiceInterface $taskService
    ) {}

    public function list(Request $request)
    {
        $user = $request->user();
        $tasks = $this->taskService->list($user);

        return response()->json([
            'tasks' => $tasks,
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $user = $request->user();
        $validated = $request->validated();
        $dto = StoreTaskDTO::fromRequest($validated);
        $task = $this->taskService->create(
            $user,
            $dto
        );

        return response()->json([
            'message' => 'Task created successfully',
            'task' => $task,
        ], 201);
    }
    public function reorder(Request $request)
    {
        $tasks = $request->input('tasks');

        $cases = [];
        $ids = [];

        foreach ($tasks as $task) {
            $id = (int) $task['id'];
            $position = (int) $task['position'];

            $cases[] = "WHEN $id THEN $position";
            $ids[] = $id;
        }

        DB::update("
        UPDATE tasks
        SET position = CASE id
            " . implode(' ', $cases) . "
        END
        WHERE id IN (" . implode(',', $ids) . ")
    ");

        return response()->json(['success' => true]);
    }
    public function update(UpdateTaskRequest $request, string $id)
    {
        $user = $request->user();
        $validated = $request->validated();
        $dto = UpdateTaskDTO::fromRequest($id, $validated);
        $task = $this->taskService->update(
            $user,
            $dto
        );

        return response()->json([
            'message' => 'Task updated successfully',
            'task' => $task,
        ], 201);
    }
    public function delete(Request $request, string $id)
    {
        $user = $request->user();
        $deleted = $this->taskService->delete($user, $id);

        if (!$deleted) {
            return response()->json([
                'message' => 'Task not found or unauthorized',
            ], 404);
        }

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
