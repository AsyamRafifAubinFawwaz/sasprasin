<?php

namespace App\Usecase\Admin;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Http\Presenter\Response;
use App\Usecase\Usecase;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardUsecase extends Usecase
{
    public function getStatistics(): array
    {
        try {
            // Get last 12 days dates
            $dates = [];
            for ($i = 11; $i >= 0; $i--) {
                $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
            }

            // Fetch statistics from complaints table with aspirations join
            $stats = DB::table(DatabaseConst::COMPLAINT)
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    DB::raw('DATE(complaints.created_at) as date'),
                    DB::raw('SUM(CASE WHEN COALESCE(aspirations.status, '.ProgressConst::PENDING.') = '.ProgressConst::PENDING.' THEN 1 ELSE 0 END) as pending'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::IN_PROGRESS.' THEN 1 ELSE 0 END) as in_progress'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::DONE.' THEN 1 ELSE 0 END) as done')
                )
                ->where('complaints.created_at', '>=', Carbon::now()->subDays(11)->startOfDay())
                ->whereNull('complaints.deleted_at')
                ->groupBy('date')
                ->get()
                ->keyBy('date');

            $chartData = [
                'categories' => [],
                'pending' => [],
                'in_progress' => [],
                'done' => [],
            ];

            foreach ($dates as $date) {
                $formattedDate = Carbon::parse($date)->format('d F Y');
                $chartData['categories'][] = $formattedDate;

                $dayStats = $stats->get($date);
                $chartData['pending'][] = $dayStats ? (int) $dayStats->pending : 0;
                $chartData['in_progress'][] = $dayStats ? (int) $dayStats->in_progress : 0;
                $chartData['done'][] = $dayStats ? (int) $dayStats->done : 0;
            }

            // Total counts for cards
            $totals = DB::table(DatabaseConst::COMPLAINT)
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(CASE WHEN COALESCE(aspirations.status, '.ProgressConst::PENDING.') = '.ProgressConst::PENDING.' THEN 1 ELSE 0 END) as pending'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::IN_PROGRESS.' THEN 1 ELSE 0 END) as in_progress'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::DONE.' THEN 1 ELSE 0 END) as done')
                )
                ->whereNull('complaints.deleted_at')
                ->first();

            $totalUsers = DB::table('users')->count();

            // Latest aspirations (complaints)
            $latestAspirations = DB::table(DatabaseConst::COMPLAINT)
                ->join(DatabaseConst::FACILITY_CATEGORY, 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->leftJoin(DatabaseConst::USER, 'complaints.student_id', '=', 'users.id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'complaints.location',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    DB::raw('COALESCE(aspirations.status, '.ProgressConst::PENDING.') as status')
                )
                ->whereNull('complaints.deleted_at')
                ->orderBy('complaints.created_at', 'desc')
                ->limit(5)
                ->get();

            return Response::buildSuccess([
                'chart' => $chartData,
                'totals' => $totals,
                'total_users' => $totalUsers,
                'latest' => $latestAspirations,
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage(), ['method' => __METHOD__]);

            return Response::buildErrorService($e->getMessage());
        }
    }
}
