<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'est_pomodoros',
        'act_pomodoros',
        'is_done',
        'position',
        'note'
    ];

    protected $casts = [
        'is_done' => 'boolean',
    ];
    public function pomodoros()
    {
        return $this->hasMany(Pomodoro::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
