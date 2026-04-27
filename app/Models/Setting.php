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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
