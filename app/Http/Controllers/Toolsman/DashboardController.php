<?php

namespace App\Http\Controllers\Toolsman;

use App\Http\Controllers\Controller;
use App\Usecase\Toolsman\DashboardUsecase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected DashboardUsecase $usecase) {}

    public function index(Request $request)
    {
        $response = $this->usecase->index($request->all());

        $stats = $response['data'] ?? [
            'totals' => (object) [
                'total' => 0,
                'pending' => 0,
                'in_progress' => 0,
                'done' => 0,
            ],
            'latest' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10),
            'chart' => [
                'categories' => [],
                'series' => [],
            ],
        ];

        return view('_toolsman.dashboard', [
            'stats' => $stats,
            'range' => $request->get('range', '30_days'),
            'error' => $response['message'] ?? null,
        ]);
    }
}
