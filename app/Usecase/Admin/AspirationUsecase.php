<?php

namespace App\Usecase\Admin;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Constants\ResponseConst;
use App\Http\Presenter\Response;
use App\Usecase\LandingUsecase;
use App\Usecase\Usecase;
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

            if (! empty($filter['status'])) {
                if ($filter['status'] == 1) {
                    $query->where(function ($q) {
                        $q->where('aspirations.status', 1)
                            ->orWhereNull('aspirations.status');
                    });
                } else {
                    $query->where('aspirations.status', $filter['status']);
                }
            }

            if (! empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }
            if (! empty($filter['location'])) {
                $query->where('locations.id', $filter['location']);
            }

            if (! empty($filter['facility_category_id'])) {
                $query->where('complaints.facility_category_id', $filter['facility_category_id']);
            }

            if (! empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('locations.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (! empty($filter['date'])) {
                $query->whereDate('complaints.created_at', $filter['date']);
            }

            return Response::buildSuccess([
                'list' => $query->orderByDesc('complaints.created_at')->paginate(8),
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
                    'aspirations.feedback',
                    'aspirations.image as aspiration_image'
                )
                ->where('complaints.id', $id)
                ->whereNull('complaints.deleted_at')
                ->first();

            if (! $data) {
                return Response::buildErrorService(ResponseConst::ERROR_MESSAGE_NOT_FOUND);
            }

            $toolsmans = DB::table(DatabaseConst::TOOLSMAN . ' as o')
                ->join(DatabaseConst::USER . ' as u', 'o.user_id', '=', 'u.id')
                ->whereNull('o.deleted_at')
                ->whereNull('u.deleted_at')
                ->select('o.id', 'u.name', 'o.skill')
                ->get();

            $assignment = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT . ' as ca')
                ->join(DatabaseConst::TOOLSMAN . ' as o', 'ca.assigned_to', '=', 'o.id')
                ->join(DatabaseConst::USER . ' as u', 'o.user_id', '=', 'u.id')
                ->where('ca.complaint_id', $id)
                ->select('u.name', 'o.skill', 'ca.assigned_at')
                ->first();

            return Response::buildSuccess([
                'data' => $data,
                'student' => (object) [
                    'name' => $data->student_name,
                    'nisn' => $data->nisn,
                    'class_name' => $data->class_name,
                ],
                'toolsmans' => $toolsmans,
                'assignment' => $assignment,
            ]);
        } catch (Exception $e) {
            Log::error('AspirationUsecase::getById - ' . $e->getMessage());

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function doAssign(Request $request, int $id): array
    {
        $validator = Validator::make($request->all(), [
            'toolsman_id' => 'required|exists:' . DatabaseConst::TOOLSMAN . ',id',
        ]);

        if ($validator->fails()) {
            return Response::buildError(ResponseConst::HTTP_BAD_REQUEST, $validator->errors()->first());
        }

        try {
            DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)->updateOrInsert(
                ['complaint_id' => $id],
                [
                    'assigned_to' => $request->toolsman_id,
                    'assigned_by' => Auth::user()->id,
                    'assigned_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $aspiration = DB::table(DatabaseConst::ASPIRATION)->where('complaint_id', $id)->first();
            if ($aspiration && $aspiration->status == ProgressConst::PENDING) {
                DB::table(DatabaseConst::ASPIRATION)->where('complaint_id', $id)->update([
                    'status' => ProgressConst::PENDING,
                    'updated_at' => now(),
                ]);

                // DB::table(DatabaseConst::ASPIRATION_STATUS_LOG)->insert([
                //     'aspiration_id' => $aspiration->id,
                //     'old_status' => ProgressConst::PENDING,
                //     'new_status' => ProgressConst::IN_PROGRESS,
                //     'note' => 'Sedang dikerjakan',
                //     'changed_by' => Auth::user()->id,
                //     'created_at' => now(),
                // ]);
            }

            LandingUsecase::clearCache();

            return Response::buildSuccess(message: 'Tugas berhasil dikirim ke petugas.');
        } catch (Exception $e) {
            Log::error('AspirationUsecase::doAssign - ' . $e->getMessage());

            return Response::buildErrorService('Gagal mengirim tugas: ' . $e->getMessage());
        }
    }

    public function updateAspiration(Request $request, int $complaintId): array
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer|in:1,2,3,4',
            'feedback' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validator->validate();

        try {
            $currentAspiration = DB::table('aspirations')
                ->where('complaint_id', $complaintId)
                ->first();

            $updateData = [
                'status' => $request->status,
                'feedback' => $request->feedback,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ];

            // Handle file upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/aspirations'), $filename);
                $updateData['image'] = 'uploads/aspirations/' . $filename;
            }

            DB::table('aspirations')
                ->where('complaint_id', $complaintId)
                ->update($updateData);

            if ($currentAspiration) {
                DB::table(DatabaseConst::ASPIRATION_STATUS_LOG)->insert([
                    'aspiration_id' => $currentAspiration->id,
                    'old_status' => $currentAspiration->status,
                    'new_status' => $request->status,
                    'note' => $request->feedback,
                    'changed_by' => Auth::id(),
                    'created_at' => now(),
                ]);
            }

            LandingUsecase::clearCache();

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
                ->leftJoin(DatabaseConst::COMPLAINT_ASSIGNMENT . ' as ca', 'complaints.id', '=', 'ca.complaint_id')
                ->leftJoin(DatabaseConst::TOOLSMAN . ' as ts', 'ca.assigned_to', '=', 'ts.id')
                ->leftJoin('users as toolsman_user', 'ts.user_id', '=', 'toolsman_user.id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'students.nisn',
                    'locations.name as location',
                    'complaints.description',
                    'complaints.image',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'aspirations.status',
                    'aspirations.feedback',
                    'aspirations.image as aspiration_image',
                    'toolsman_user.name as toolsman_name'
                )
                ->whereNull('complaints.deleted_at');

            if (! empty($filter['status'])) {
                if ($filter['status'] == 1) {
                    $query->where(function ($q) {
                        $q->where('aspirations.status', 1)
                            ->orWhereNull('aspirations.status');
                    });
                } else {
                    $query->where('aspirations.status', $filter['status']);
                }
            }

            if (! empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }

            if (! empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('locations.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (! empty($filter['export_all'])) {
                // Ignore all filters if export_all is checked
                return Response::buildSuccess([
                    'list' => $query->orderByDesc('complaints.created_at')->get(),
                ]);
            }

            if (! empty($filter['date'])) {
                $query->whereDate('complaints.created_at', $filter['date']);
            }

            if (! empty($filter['start_date'])) {
                $query->whereDate('complaints.created_at', '>=', $filter['start_date']);
            }

            if (! empty($filter['end_date'])) {
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

    public function getAllForExcel(array $filter = []): array
    {
        try {
            $query = DB::table(DatabaseConst::COMPLAINT)
                ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->leftJoin(DatabaseConst::COMPLAINT_ASSIGNMENT . ' as ca', 'complaints.id', '=', 'ca.complaint_id')
                ->leftJoin(DatabaseConst::TOOLSMAN . ' as ts', 'ca.assigned_to', '=', 'ts.id')
                ->leftJoin('users as toolsman_user', 'ts.user_id', '=', 'toolsman_user.id')
                ->select(
                    'complaints.id',
                    'users.name as student_name',
                    'students.nisn',
                    'locations.name as location',
                    'complaints.description',
                    'complaints.image',
                    'complaints.created_at',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'aspirations.status',
                    'aspirations.feedback',
                    'aspirations.image as aspiration_image',
                    'toolsman_user.name as toolsman_name'
                )
                ->whereNull('complaints.deleted_at');

            if (! empty($filter['status'])) {
                if ($filter['status'] == 1) {
                    $query->where(function ($q) {
                        $q->where('aspirations.status', 1)
                            ->orWhereNull('aspirations.status');
                    });
                } else {
                    $query->where('aspirations.status', $filter['status']);
                }
            }

            if (! empty($filter['priority'])) {
                $query->where('facility_categories.priority', $filter['priority']);
            }

            if (! empty($filter['search'])) {
                $query->where(function ($q) use ($filter) {
                    $q->where('users.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('locations.name', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('complaints.description', 'like', '%' . $filter['search'] . '%');
                });
            }

            if (! empty($filter['export_all'])) {
                // Ignore all filters if export_all is checked
                return Response::buildSuccess([
                    'list' => $query->orderByDesc('complaints.created_at')->get(),
                ]);
            }

            if (! empty($filter['date'])) {
                $query->whereDate('complaints.created_at', $filter['date']);
            }

            if (! empty($filter['start_date'])) {
                $query->whereDate('complaints.created_at', '>=', $filter['start_date']);
            }

            if (! empty($filter['end_date'])) {
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
