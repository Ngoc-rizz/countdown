<?php

namespace Modules\Pomodoro\Services\Contracts;

use App\Models\User;
use Modules\Pomodoro\DTOs\FinishPomodoroDTO;
use Modules\Pomodoro\DTOs\PausePomodoroDTO;
use Modules\Pomodoro\DTOs\StartPomodoroDTO;

interface PomodoroServiceInterface
{
    public function getPomodoro(?User $user);
    public function start(StartPomodoroDTO $dto);
    public function pause(PausePomodoroDTO $dto);
    public function finish(FinishPomodoroDTO $dto);
}
