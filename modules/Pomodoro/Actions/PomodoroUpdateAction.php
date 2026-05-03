<?php

namespace Modules\Pomodoro\Actions;

use App\Models\Pomodoro;
use App\Models\Task;
use Modules\Pomodoro\DTOs\FinishPomodoroDTO;
use Modules\Pomodoro\DTOs\PausePomodoroDTO;

class PomodoroUpdateAction
{
    public function execute(PausePomodoroDTO|FinishPomodoroDTO $dto)
    {
        if ($dto->type !== 'pomodoro') {
            return;
        }

        $session = Pomodoro::where('user_id', $dto->userId)
            ->whereIn('status', ['running', 'paused'])
            ->latest()
            ->first();

        if (!$session) {
            return;
        }
        if ($dto instanceof PausePomodoroDTO) {
            $this->handlePause($session, $dto);
        } else {
            $this->handleFinish($session, $dto);
        }
    }

    private function handlePause(Pomodoro $session, PausePomodoroDTO $dto): void
    {
        $elapsedSeconds = max(0, $session->scheduled_duration - $dto->timeLeft);

        $session->update([
            'actual_duration' => $elapsedSeconds,
            'status' => 'paused',
            'task_id' => $dto->taskId,
        ]);
    }

    private function handleFinish(Pomodoro $session, FinishPomodoroDTO $dto): void
    {

        $totalConfigSeconds = $session->scheduled_duration;

        $actualDuration = $totalConfigSeconds - $dto->timeLeft;

        $session->update([
            'actual_duration' => max(0, min($actualDuration, $totalConfigSeconds)),
            'status' => 'finished',
            'end_time' => now(),
            'task_id' => $dto->taskId
        ]);

        if ($dto->taskId) {
            $task = Task::find($dto->taskId);
            if ($task && !$task->is_done) {
                $task->increment('act_pomodoros');

                if ($task->act_pomodoros >= $task->est_pomodoros) {
                    $task->update(['is_done' => true]);
                }
            }
        }
    }
}
