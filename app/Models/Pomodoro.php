<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pomodoro extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'start_time',
        'end_time',
        'actual_duration',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
