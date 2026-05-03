<?php

namespace Modules\Pomodoro\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PomodoroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:pomodoro',
        ];
    }
}
