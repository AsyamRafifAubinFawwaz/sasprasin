<?php

namespace App\Usecase;

use App\Constants\DatabaseConst;
use App\Constants\ResponseConst;
use App\Http\Presenter\Response;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LandingUsecase
{
    protected const CACHE_TTL = 3600; // 1 hour
    protected const CACHE_PREFIX = 'landing_';

    public static function clearCache(): void
    {
        Cache::flush();
    }

    public function getLatestAspirations(int $limit = 6): array
    {
        try {
            $cacheKey = self::CACHE_PREFIX . 'latest_' . $limit;

            return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($limit) {
                $query = $this->getBaseQuery();

                return Response::buildSuccess([
                    'list' => $query->orderByDesc('complaints.created_at')->limit($limit)->get(),
                ]);
            });
        } catch (Exception $e) {
            Log::error('LandingUsecase::getLatestAspirations - ' . $e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getAllAspirations(array $filter = []): array
    {
        try {
            $page = request()->get('page', 1);
            $cacheKey = self::CACHE_PREFIX . 'all_' . md5(json_encode($filter) . $page);

            return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($filter) {
                $query = $this->getBaseQuery();

                if (!empty($filter['status'])) {
                    $query->where('aspirations.status', $filter['status']);
                }

                if (!empty($filter['facility_category_id'])) {
                    $query->where('complaints.facility_category_id', $filter['facility_category_id']);
                }

                if (!empty($filter['search'])) {
                    $query->where(function ($q) use ($filter) {
                        $q->where('locations.name', 'like', '%' . $filter['search'] . '%')
                            ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%')
                            ->orWhere('facility_categories.name', 'like', '%' . $filter['search'] . '%');
                    });
                }

                if (!empty($filter['date'])) {
                    $query->whereDate('complaints.created_at', $filter['date']);
                }

                return Response::buildSuccess([
                    'list' => $query->orderByDesc('complaints.created_at')->paginate(12),
                ]);
            });
        } catch (Exception $e) {
            Log::error('LandingUsecase::getAllAspirations - ' . $e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getById(int $id): array
    {
        try {
            $cacheKey = self::CACHE_PREFIX . 'detail_' . $id;

            return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($id) {
                $data = $this->getBaseQuery()
                    ->addSelect('aspirations.id as aspiration_id', 'aspirations.image as aspiration_image', 'aspirations.feedback')
                    ->where('complaints.id', $id)
                    ->first();

                if (!$data) {
                    return Response::buildErrorService(ResponseConst::ERROR_MESSAGE_NOT_FOUND);
                }

                // Fetch status logs
                $logs = [];
                if ($data->aspiration_id) {
                    $logs = DB::table(DatabaseConst::ASPIRATION_STATUS_LOG)
                        ->join('users', DatabaseConst::ASPIRATION_STATUS_LOG . '.changed_by', '=', 'users.id')
                        ->where('aspiration_id', $data->aspiration_id)
                        ->select(DatabaseConst::ASPIRATION_STATUS_LOG . '.*', 'users.name as changer_name')
                        ->orderBy(DatabaseConst::ASPIRATION_STATUS_LOG . '.created_at', 'desc')
                        ->get();
                }

                return Response::buildSuccess([
                    'data' => $data,
                    'logs' => $logs,
                ]);
            });
        } catch (Exception $e) {
            Log::error('LandingUsecase::getById - ' . $e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }

    protected function getBaseQuery()
    {
        return DB::table(DatabaseConst::COMPLAINT)
            ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
            ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
            ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
            ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
            ->select(
                'complaints.id',
                'users.name as student_name',
                'locations.name as location',
                'complaints.description',
                'complaints.image',
                'complaints.created_at',
                'facility_categories.name as category_name',
                'facility_categories.priority',
                DB::raw('COALESCE(aspirations.status, 1) as status')
            )
            ->whereNull('complaints.deleted_at');
    }
}
