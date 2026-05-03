<?php

namespace Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Report\Services\Contracts\ReportServiceInterface;

class ReportController extends Controller
{
    public function __construct(private ReportServiceInterface $reportService) {}

    public function getReportData()
    {
        $user = Auth::user();
        return view('pages.report', [
            'summary' => $this->reportService->getSummary($user),
            'chart'   => $this->reportService->getChartData($user),
            'details' => $this->reportService->getDetails($user),
        ]);
    }
}
