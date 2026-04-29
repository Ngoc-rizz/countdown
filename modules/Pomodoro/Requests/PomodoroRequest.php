<?php

namespace App\Modules\Pomodoro\Requests;

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
            //
        ];
    }
}