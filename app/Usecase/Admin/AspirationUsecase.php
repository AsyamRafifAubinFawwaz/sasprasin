<?php

namespace App\Usecase\Admin;

use App\Constants\DatabaseConst;
use App\Constants\ResponseConst;
use App\Http\Presenter\Response;
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
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'locations.name as location',
                    'complaints.description',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'facility_categories.example_items',
                    'aspirations.status',
                    'aspirations.feedback'
                )
                ->whereNull('complaints.deleted_at');

            if (!empty($filter['status'])) {
                if ($filter['status'] == 1) {
                    $query->where(function ($q) {
                        $q->where('aspirations.status', 1)
                            ->orWhereNull('aspirations.status');
                    });
                } else {
                    $query->where('aspirations.status', $filter['status']);
                }

            }

            if (!empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }

            if (!empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('locations.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (!empty($filter['date'])) {
                $query->whereDate('complaints.created_at', $filter['date']);
            }

            return Response::buildSuccess([
                'list' => $query->orderByDesc('complaints.created_at')->paginate(20),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getById(int $id): array
    {
        try {
            $data = DB::table(DatabaseConst::COMPLAINT)
                ->leftJoin('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->leftJoin('classrooms', 'students.classroom_id', '=', 'classrooms.id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'students.nisn',
                    'classrooms.class_name',
                    'locations.name as location',
                    'complaints.description',
                    'complaints.image',
                    'complaints.created_at',
                    DB::raw('COALESCE(facility_categories.name, "Tidak ada kategori") as category_name'),
                    DB::raw('COALESCE(facility_categories.priority, 1) as priority'),
                    DB::raw('COALESCE(facility_categories.example_items, "Tidak ada contoh") as example_items'),
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
                'data' => $data,
                'student' => (object) [
                    'name' => $data->student_name,
                    'nisn' => $data->nisn,
                    'class_name' => $data->class_name,
                ],
            ]);
        } catch (Exception $e) {
            Log::error('AspirationUsecase::getById - ' . $e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function updateAspiration(Request $request, int $complaintId): array
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer|in:1,2,3,4',
            'feedback' => 'nullable|string',
        ]);

        $validator->validate();

        try {
            $currentAspiration = DB::table('aspirations')
                ->where('complaint_id', $complaintId)
                ->first();

            DB::table('aspirations')
                ->where('complaint_id', $complaintId)
                ->update([
                    'status' => $request->status,
                    'feedback' => $request->feedback,
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]);

            if ($currentAspiration) {
                DB::table('aspiration_status_logs')->insert([
                    'aspiration_id' => $currentAspiration->id,
                    'old_status' => $currentAspiration->status,
                    'new_status' => $request->status,
                    'note' => $request->feedback,
                    'changed_by' => Auth::id(),
                    'created_at' => now(),
                ]);
            }

            return Response::buildSuccess(
                message: ResponseConst::SUCCESS_MESSAGE_UPDATED
            );
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getAllForPdf(array $filter = []): array
    {
        try {
            $query = DB::table(DatabaseConst::COMPLAINT)
                ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
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
                    'aspirations.status',
                    'aspirations.feedback'
                )
                ->whereNull('complaints.deleted_at');

            if (!empty($filter['status'])) {
                if ($filter['status'] == 1) {
                    $query->where(function ($q) {
                        $q->where('aspirations.status', 1)
                            ->orWhereNull('aspirations.status');
                    });
                } else {
                    $query->where('aspirations.status', $filter['status']);
                }
            }

            if (!empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }

            if (!empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('locations.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (!empty($filter['export_all'])) {
                // Ignore all filters if export_all is checked
                return Response::buildSuccess([
                    'list' => $query->orderByDesc('complaints.created_at')->get(),
                ]);
            }

            if (!empty($filter['date'])) {
                $query->whereDate('complaints.created_at', $filter['date']);
            }

            if (!empty($filter['start_date'])) {
                $query->whereDate('complaints.created_at', '>=', $filter['start_date']);
            }

            if (!empty($filter['end_date'])) {
                $query->whereDate('complaints.created_at', '<=', $filter['end_date']);
            }

            return Response::buildSuccess([
                'list' => $query->orderByDesc('complaints.created_at')->get(),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }
}
