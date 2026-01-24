<?php

namespace App\Usecase\Student;

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
    public function getStatistics(int $studentId): array
    {
        try {
            // ========== CARD STATISTICS ==========
            $stats = DB::table(DatabaseConst::COMPLAINT)
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(CASE WHEN COALESCE(aspirations.status, '.ProgressConst::PENDING.') = '.ProgressConst::PENDING.' THEN 1 ELSE 0 END) as pending'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::IN_PROGRESS.' THEN 1 ELSE 0 END) as in_progress'),
                    DB::raw('SUM(CASE WHEN aspirations.status = '.ProgressConst::DONE.' THEN 1 ELSE 0 END) as done'),
                    DB::raw('SUM(CASE WHEN aspirations.status = 4 THEN 1 ELSE 0 END) as rejected')
                )
                ->where('complaints.student_id', $studentId)
                ->whereNull('complaints.deleted_at')
                ->first();

            // ========== LATEST COMPLAINTS ==========
            $latest = DB::table(DatabaseConst::COMPLAINT)
                ->join(DatabaseConst::FACILITY_CATEGORY, 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    'complaints.id',
                    'locations.name as location',
                    'complaints.created_at',
                    'facility_categories.name as facility_category_name',
                    DB::raw('COALESCE(aspirations.status, '.ProgressConst::PENDING.') as status')
                )
                ->where('complaints.student_id', $studentId)
                ->whereNull('complaints.deleted_at')
                ->orderBy('complaints.created_at', 'desc')
                ->limit(5)
                ->get();

            // ========== CHART (12 BULAN TERAKHIR) ==========
            $months = [];
            for ($i = 11; $i >= 0; $i--) {
                $months[] = Carbon::now()->subMonths($i)->format('Y-m');
            }

            $chartStats = DB::table(DatabaseConst::COMPLAINT)
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('student_id', $studentId)
                ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
                ->whereNull('deleted_at')
                ->groupBy('month')
                ->get()
                ->keyBy('month');

            $chartData = [
                'categories' => [],
                'series' => [],
            ];

            foreach ($months as $month) {
                $chartData['categories'][] =
                    Carbon::parse($month.'-01')->format('M Y');

                $chartData['series'][] =
                    (int) (optional($chartStats->get($month))->total ?? 0);
            }

            return Response::buildSuccess([
                'stats' => $stats,
                'latest' => $latest,
                'chart' => $chartData,
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage(), ['method' => __METHOD__]);

            return Response::buildErrorService($e->getMessage());
        }
    }
}
