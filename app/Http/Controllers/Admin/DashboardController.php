<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Usecase\Admin\DashboardUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardUsecase $usecase
    ) {}

    public function index(\Illuminate\Http\Request $request): View|Response
    {
        $range = $request->get('range', '30_days');
        $response = $this->usecase->getStatistics($range);
        $stats = $response['data'] ?? [
            'chart' => [
                'categories' => [],
                'series' => [],
            ],
            'totals' => (object) [
                'total' => 0,
                'pending' => 0,
                'in_progress' => 0,
                'done' => 0,
            ],
            'total_users' => 0,
            'latest' => [],
        ];

        return view('_admin.dashboard', compact('stats', 'range'));
    }
}
