<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Usecase\Student\DashboardUsecase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardUsecase $usecase
    ) {
    }

    public function index(): View|Response
    {
        $response = $this->usecase->getStatistics(Auth::user()->id);
        $data = $response['data'] ?? [];

        return view('_student.dashboard', [
            'stats' => $data['stats'] ?? null,
            'latest' => $data['latest'] ?? [],
            'chart' => $data['chart'] ?? [],
        ]);
    }
}
