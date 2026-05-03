<?php

namespace Modules\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'est_pomodoros' => 'required|integer|min:1|max:4',
            'act_pomodoros' => 'required|integer|min:0',
            'note' => 'nullable|string|max:500',
            'is_done' => 'sometimes|boolean',
            'position' => 'sometimes|integer',
        ];
    }
}
