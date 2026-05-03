<?php

namespace Modules\Pomodoro\Services;

use App\Models\User;
use Modules\Pomodoro\Actions\PomodoroGetAction;
use Modules\Pomodoro\Actions\PomodoroStoreAction;
use Modules\Pomodoro\Actions\PomodoroUpdateAction;
use Modules\Pomodoro\DTOs\FinishPomodoroDTO;
use Modules\Pomodoro\DTOs\PausePomodoroDTO;
use Modules\Pomodoro\DTOs\StartPomodoroDTO;
use Modules\Pomodoro\Services\Contracts\PomodoroServiceInterface;

class PomodoroService implements PomodoroServiceInterface
{
    public function __construct(protected PomodoroGetAction $getAction, protected PomodoroStoreAction $createAction, protected PomodoroUpdateAction $updateAction) {}

    public function getPomodoro(?User $user)
    {
        return $this->getAction->execute($user);
    }

    public function start(StartPomodoroDTO $dto)
    {
        return $this->createAction->execute($dto);
    }
    public function pause(PausePomodoroDTO $dto)
    {
        return $this->updateAction->execute($dto);
    }
    public function finish(FinishPomodoroDTO $dto)
    {
        return $this->updateAction->execute($dto);
    }
}
