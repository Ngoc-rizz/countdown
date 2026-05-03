<?php

namespace Modules\Report\Services\Contracts;

use App\Models\User;

interface ReportServiceInterface
{
    public function getSummary(User $user);
    public function getChartData(User $user);
    public function getDetails(User $user);
}
