<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'user_id',
        'theme_color',
        'pomodoro_minutes',
        'break_minutes',
        'auto_check_tasks',
        'sound_enabled'
    ];

    protected $casts = [
        'auto_check_tasks' => 'boolean',
        'sound_enabled' => 'boolean',
    ];
    public function toFrontend(): array
    {
        return [
            'pomodoro'     => $this->pomodoro_minutes,
            'break'        => $this->break_minutes,
            'autoCheck'    => (bool) $this->auto_check_tasks,
            'soundEnabled' => (bool) $this->sound_enabled,
            'themeColor'   => $this->theme_color,
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
