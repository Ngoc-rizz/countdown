<?php

namespace Modules\Pomodoro\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Pomodoro\DTOs\FinishPomodoroDTO;
use Modules\Pomodoro\DTOs\PausePomodoroDTO;
use Modules\Pomodoro\DTOs\StartPomodoroDTO;
use Modules\Pomodoro\Requests\PomodoroFinishRequest;
use Modules\Pomodoro\Requests\PomodoroPauseRequest;
use Modules\Pomodoro\Requests\PomodoroRequest;
use Modules\Pomodoro\Services\Contracts\PomodoroServiceInterface;
use Modules\Task\Services\Contracts\TaskServiceInterface;

class PomodoroController extends Controller
{
    public function __construct(protected PomodoroServiceInterface $service, private TaskServiceInterface $taskService) {}

    public function index(Request $request)
    {
        if (Auth::check() && is_null($request->user()->email_verified_at)) {
            return redirect()->route('verification.notice');
        }

        $pomodoro = $this->service->getPomodoro($request->user());
        $user = $request->user();
        $tasks = $user
            ? $this->taskService->list($user)
            : collect();

        return view('pages.pomodoro', compact('pomodoro', 'tasks'));
    }
    public function start(PomodoroRequest $request)
    {
        try {
            $validated = $request->validated();
            $dto = StartPomodoroDTO::fromRequest($validated);
            $this->service->start($dto);
            return response()->json(['message' => 'Started'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function pause(PomodoroPauseRequest $request)
    {
        try {
            $validated = $request->validated();
            $dto = PausePomodoroDTO::fromRequest($validated);
            $this->service->pause($dto);
            return response()->json(['message' => 'Paused'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function finish(PomodoroFinishRequest $request)
    {
        try {
            $validated = $request->validated();
            $dto = FinishPomodoroDTO::fromRequest($validated);
            $this->service->finish($dto);
            return response()->json(['message' => 'Finished'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
