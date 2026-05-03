<?php

namespace Modules\Report\Services;

use App\Models\User;
use Modules\Report\Services\Contracts\ReportServiceInterface;

class ReportService implements ReportServiceInterface
{
    public function __construct() {}
    public function getSummary(User $user)
    {
        return [
            'total_pomo_completed' => $user->pomodoros()->where('status', 'finished')->count(),
            'total_hours' => round($user->pomodoros()->sum('actual_duration') / 3600, 1),
            'task_stats' => $user->tasks()
                ->withSum('pomodoros as total_time', 'actual_duration')
                ->get(['id', 'title', 'act_pomodoros', 'est_pomodoros'])
        ];
    }
    public function getChartData(User $user)
    {
        $data = $user->pomodoros()
            ->whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('status', 'finished')
            ->selectRaw('DATE(start_time) as date, SUM(actual_duration) as seconds')
            ->groupBy('date')
            ->pluck('seconds', 'date');

        return $data->map(fn($seconds) => round($seconds / 60, 1));
    }

    public function getDetails(User $user)
    {
        return $user->pomodoros()
            ->with('task:id,title')
            ->orderBy('start_time', 'desc')
            ->paginate(10);
    }
}
