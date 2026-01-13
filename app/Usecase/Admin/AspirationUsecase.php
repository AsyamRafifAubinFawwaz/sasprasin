<?php

namespace App\Usecase\Admin;

use App\Constants\DatabaseConst;
use App\Http\Presenter\Response;
use App\Constants\ResponseConst;
use Dflydev\DotAccessData\Data;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AspirationUsecase
{
    public function getAll(array $filter = []): array
    {
        try {
            $query = DB::table(DatabaseConst::COMPLAINT)
                ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'complaints.location',
                    'complaints.description',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'aspirations.status',
                    'aspirations.feedback'
                )
                ->whereNull('complaints.deleted_at');

            if (!empty($filter['status'])) {
                $query->where('aspirations.status', $filter['status']);
            }

            if (!empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }

            if (!empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.location', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (!empty($filter['date_from']) && !empty($filter['date_to'])) {
                $query->whereBetween('complaints.created_at', [
                    $filter['date_from'] . ' 00:00:00',
                    $filter['date_to'] . ' 23:59:59',
                ]);
            }


            return Response::buildSuccess([
                'list' => $query->orderByDesc('complaints.created_at')->paginate(20)
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }


    public function getById(int $id): array
    {
        try {
            $data = DB::table('complaints')
                ->leftJoin('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'complaints.location',
                    'complaints.description',
                    'complaints.image',
                    'complaints.created_at',
                    DB::raw('COALESCE(facility_categories.name, "Tidak ada kategori") as category_name'),
                    DB::raw('COALESCE(facility_categories.priority, 1) as priority'),
                    DB::raw('COALESCE(aspirations.status, 1) as status'),
                    'aspirations.feedback'
                )
                ->where('complaints.id', $id)
                ->whereNull('complaints.deleted_at')
                ->first();

            if (!$data) {
                return Response::buildErrorService(ResponseConst::ERROR_MESSAGE_NOT_FOUND);
            }

            return Response::buildSuccess([
                'data' => $data
            ]);
        } catch (Exception $e) {
            Log::error('AspirationUsecase::getById - ' . $e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }


    public function updateAspiration(Request $request, int $complaintId): array
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer|in:1,2,3',
            'feedback' => 'nullable|string',
        ]);

        $validator->validate();

        try {
            DB::table('aspirations')
                ->where('complaint_id', $complaintId)
                ->update([
                    'status' => $request->status,
                    'feedback' => $request->feedback,
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]);

            return Response::buildSuccess(
                message: ResponseConst::SUCCESS_MESSAGE_UPDATED
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }
}
