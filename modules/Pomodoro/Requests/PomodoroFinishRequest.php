<?php

namespace Modules\Pomodoro\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PomodoroFinishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:pomodoro',
            'timeLeft' => 'required|integer',
            'taskId' => 'nullable|integer|exists:tasks,id'
        ];
    }
}
