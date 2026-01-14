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
    ) {
    }

    public function index(): View|Response
    {
        \Illuminate\Support\Facades\Log::info('DashboardController@index hit');
        $stats = $this->usecase->getStatistics();

        return view('_admin.dashboard', [
            'stats' => $stats['data'] ?? [],
        ]);
    }
}
