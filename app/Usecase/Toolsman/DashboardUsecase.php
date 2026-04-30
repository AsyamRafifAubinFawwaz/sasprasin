<?php

namespace App\Usecase\Toolsman;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Http\Presenter\Response;
use App\Usecase\Usecase;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardUsecase extends Usecase
{
    public function index(array $filter = []): array
    {
        try {
            $toolsmanId = DB::table(DatabaseConst::TOOLSMAN)->where('user_id', Auth::id())->value('id');

            if (!$toolsmanId) {
                return Response::buildError(403, 'Data Petugas tidak ditemukan.');
            }

            $range = $filter['range'] ?? '30_days';
            $days = match ($range) {
                '12_days' => 11,
                '1_year' => 12,
                default => 29,
            };

            $chartData = [
                'categories' => [],
                'series' => [],
            ];

            if ($range === '1_year') {
                $months = [];
                for ($i = $days - 1; $i >= 0; $i--) {
                    $months[] = Carbon::now()->subMonths($i)->format('Y-m');
                }

                $stats = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                    ->where('assigned_to', $toolsmanId)
                    ->select(
                        DB::raw('DATE_FORMAT(assigned_at, "%Y-%m") as month'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('assigned_at', '>=', Carbon::now()->subMonths($days - 1)->startOfMonth())
                    ->groupBy('month')
                    ->get()
                    ->keyBy('month');

                foreach ($months as $month) {
                    $chartData['categories'][] = Carbon::parse($month . '-01')->format('M Y');
                    $chartData['series'][] = (int) (optional($stats->get($month))->total ?? 0);
                }
            } else {
                $dates = [];
                for ($i = $days; $i >= 0; $i--) {
                    $dates[] = Carbon::now()->subDays($i)->format('Y-m-d');
                }

                $stats = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                    ->where('assigned_to', $toolsmanId)
                    ->select(
                        DB::raw('DATE(assigned_at) as date'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('assigned_at', '>=', Carbon::now()->subDays($days)->startOfDay())
                    ->groupBy('date')
                    ->get()
                    ->keyBy('date');

                foreach ($dates as $date) {
                    $chartData['categories'][] = Carbon::parse($date)->format('d M Y');
                    $chartData['series'][] = (int) (optional($stats->get($date))->total ?? 0);
                }
            }

            $totals = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaint_assignments.complaint_id', '=', 'aspirations.complaint_id')
                ->where('complaint_assignments.assigned_to', $toolsmanId)
                ->select(
                    DB::raw('count(*) as total'),
                    DB::raw('count(case when aspirations.status = ' . ProgressConst::PENDING . ' or aspirations.status is null then 1 end) as pending'),
                    DB::raw('count(case when aspirations.status = ' . ProgressConst::IN_PROGRESS . ' then 1 end) as in_progress'),
                    DB::raw('count(case when aspirations.status = ' . ProgressConst::DONE . ' then 1 end) as done')
                )
                ->first();

            $latest = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                ->join(DatabaseConst::COMPLAINT, 'complaint_assignments.complaint_id', '=', 'complaints.id')
                ->leftJoin(DatabaseConst::ASPIRATION, 'complaints.id', '=', 'aspirations.complaint_id')
                ->leftJoin(DatabaseConst::FACILITY_CATEGORY, 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin(DatabaseConst::LOCATION, 'complaints.location_id', '=', 'locations.id')
                ->leftJoin(DatabaseConst::USER, 'complaints.student_id', '=', 'users.id')
                ->where('complaint_assignments.assigned_to', $toolsmanId)
                ->select(
                    'aspirations.id', // Use aspiration ID for detail link
                    'users.name as student_name',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'locations.name as location',
                    'aspirations.status',
                    'complaint_assignments.assigned_at as created_at'
                )
                ->orderByDesc('complaint_assignments.assigned_at')
                ->paginate(10);

            return Response::buildSuccess([
                'chart' => $chartData,
                'totals' => $totals,
                'latest' => $latest,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['method' => __METHOD__]);
            return Response::buildErrorService($e->getMessage());
        }
    }
}
