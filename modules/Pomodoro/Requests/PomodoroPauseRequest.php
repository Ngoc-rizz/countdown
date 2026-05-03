<?php

namespace Modules\Pomodoro\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PomodoroPauseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:pomodoro',
            'timeLeft' => 'required|integer|min:0',
            'taskId' => 'nullable|exists:tasks,id',
        ];
    }
}
