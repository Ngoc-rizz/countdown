<?php

namespace Modules\Settings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'pomodoro' => 'required|integer|min:1|max:120',
            'break' => 'required|integer|min:1|max:60',
            'theme_color' => [
                'required',
                'string',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],
            'auto_check' => 'required|boolean',
            'sound_enabled' => 'required|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'auto_check' => $this->boolean('auto_check'),
            'sound_enabled' => $this->boolean('sound_enabled'),
        ]);
    }
}
