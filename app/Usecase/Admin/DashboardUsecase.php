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
    public function getStatistics(string $range = '30_days'): array
    {
        try {
            $useMonthlyGrouping = $range === '1_year';

            // Determine days/period based on range
            $days = match ($range) {
                '12_days' => 11,
                '1_year' => 12, // months
                default => 29, // 30_days
            };

            $chartData = [
                'categories' => [],
                'series' => [],
            ];

            if ($useMonthlyGrouping) {
                $months = [];
                for ($i = $days - 1; $i >= 0; $i--) {
                    $months[] = Carbon::now()->subMonths($i)->format('Y-m');
                }

                $stats = DB::table(DatabaseConst::COMPLAINT)
                    ->select(
                        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('created_at', '>=', Carbon::now()->subMonths($days - 1)->startOfMonth())
                    ->whereNull('deleted_at')
                    ->groupBy('month')
                    ->get()
                    ->keyBy('month');

                foreach ($months as $month) {
                    $chartData['categories'][] = Carbon::parse($month.'-01')->format('M Y');
                    $chartData['series'][] = (int) (optional($stats->get($month))->total ?? 0);
                }
            } else {
                // Get dates for the range
                $dates = [];
                for ($i = $days; $i >= 0; $i--) {
                    $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
                }

                $stats = DB::table(DatabaseConst::COMPLAINT)
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('created_at', '>=', Carbon::now()->subDays($days)->startOfDay())
                    ->whereNull('deleted_at')
                    ->groupBy('date')
                    ->get()
                    ->keyBy('date');

                foreach ($dates as $date) {
                    $chartData['categories'][] = Carbon::parse($date)->format('d M Y');
                    $chartData['series'][] = (int) (optional($stats->get($date))->total ?? 0);
                }
            }

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

            $latestAspirations = DB::table(DatabaseConst::COMPLAINT)
                ->join(DatabaseConst::FACILITY_CATEGORY, 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin(DatabaseConst::LOCATION, 'complaints.location_id', '=', 'locations.id')
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->leftJoin(DatabaseConst::USER, 'complaints.student_id', '=', 'users.id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'locations.name as location',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    DB::raw('COALESCE(aspirations.status, '.ProgressConst::PENDING.') as status')
                )
                ->whereNull('complaints.deleted_at')
                ->orderByRaw('
        CASE COALESCE(aspirations.status, '.ProgressConst::PENDING.')
            WHEN '.ProgressConst::PENDING.' THEN 1
            WHEN '.ProgressConst::IN_PROGRESS.' THEN 2
            WHEN '.ProgressConst::DONE.' THEN 3
            WHEN '.ProgressConst::REJECT.' THEN 4
            ELSE 5
        END
    ')
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
