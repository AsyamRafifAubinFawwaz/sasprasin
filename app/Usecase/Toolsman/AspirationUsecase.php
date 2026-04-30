<?php

namespace App\Usecase\Toolsman;

use App\Constants\DatabaseConst;
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

class AspirationUsecase extends Usecase
{
    public function getAll(array $filter = []): array
    {
        try {
            $toolsmanId = DB::table('toolsman')->where('user_id', Auth::id())->value('id');

            if (!$toolsmanId) {
                return Response::buildError(403, 'Toolsman data not found.');
            }

            $query = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                ->join(DatabaseConst::COMPLAINT, 'complaint_assignments.complaint_id', '=', 'complaints.id')
                ->join('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->leftJoin('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->where('complaint_assignments.assigned_to', $toolsmanId)
                ->select(
                    'aspirations.id',
                    'users.name as student_name',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'facility_categories.example_items',
                    'locations.name as location',
                    'aspirations.status',
                    'aspirations.feedback',
                    'complaints.description',
                    'complaint_assignments.assigned_at as created_at'
                );

            $query->when($filter['status'] ?? false, function ($q, $status) {
                $q->where('aspirations.status', $status);
            })->when($filter['priority'] ?? false, function ($q, $priority) {
                $q->where('facility_categories.priority', $priority);
            })->when($filter['facility_category_id'] ?? false, function ($q, $categoryId) {
                $q->where('complaints.facility_category_id', $categoryId);
            })->when($filter['date'] ?? false, function ($q, $date) {
                $q->whereDate('complaint_assignments.assigned_at', $date);
            })->when($filter['location'] ?? false, function ($q, $locationId) {
                $q->where('locations.id', $locationId);
            })->when(($filter['keywords'] ?? $filter['search'] ?? false), function ($q, $keywords) {
                $q->where(function ($sq) use ($keywords) {
                    $sq->where('users.name', 'like', '%' . $keywords . '%')
                        ->orWhere('complaints.description', 'like', '%' . $keywords . '%');
                });
            });

            $data = $query->orderByDesc('complaint_assignments.assigned_at')->paginate(20);

            if (!empty($filter)) {
                $data->appends($filter);
            }

            return Response::buildSuccess(['list' => $data]);
        } catch (Exception $e) {
            Log::error('Toolsman\AspirationUsecase::getAll - ' . $e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getById(int $id): array
    {
        try {
            $toolsmanId = DB::table('toolsman')->where('user_id', Auth::id())->value('id');

            $data = DB::table('aspirations')
                ->join(DatabaseConst::COMPLAINT, 'aspirations.complaint_id', '=', 'complaints.id')
                ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('locations', 'complaints.location_id', '=', 'locations.id')
                ->leftJoin('users', 'complaints.student_id', '=', 'users.id')
                ->leftJoin('students', 'users.id', '=', 'students.user_id')
                ->join('complaint_assignments', 'complaints.id', '=', 'complaint_assignments.complaint_id')
                ->where('aspirations.id', $id)
                ->where('complaint_assignments.assigned_to', $toolsmanId)
                ->select(
                    'aspirations.*',
                    'complaints.description',
                    'complaints.image as complaint_image',
                    'users.name as student_name',
                    'students.nisn',
                    'locations.name as location_name',
                    'facility_categories.name as category_name',
                    'facility_categories.priority',
                    'complaint_assignments.assigned_at'
                )
                ->first();

            if (!$data) {
                return Response::buildErrorNotFound();
            }

            // Get timeline
            $timeline = DB::table(DatabaseConst::ASPIRATION_STATUS_LOG)
                ->leftJoin('users', DatabaseConst::ASPIRATION_STATUS_LOG . '.changed_by', '=', 'users.id')
                ->where(DatabaseConst::ASPIRATION_STATUS_LOG . '.aspiration_id', $id)
                ->select(
                    DatabaseConst::ASPIRATION_STATUS_LOG . '.old_status',
                    DatabaseConst::ASPIRATION_STATUS_LOG . '.new_status',
                    DatabaseConst::ASPIRATION_STATUS_LOG . '.note',
                    DatabaseConst::ASPIRATION_STATUS_LOG . '.created_at',
                    'users.name as changed_by_name'
                )
                ->orderByDesc(DatabaseConst::ASPIRATION_STATUS_LOG . '.created_at')
                ->get();

            return Response::buildSuccess([
                'data' => $data,
                'timeline' => $timeline
            ]);
        } catch (Exception $e) {
            Log::error('Toolsman\AspirationUsecase::getById - ' . $e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }

    public function update(Request $request, int $id): array
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:2,3',
            'feedback' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return Response::buildError(ResponseConst::HTTP_BAD_REQUEST, $validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $toolsmanId = DB::table(DatabaseConst::TOOLSMAN)->where('user_id', Auth::id())->value('id');
            $aspiration = DB::table(DatabaseConst::ASPIRATION)->where('id', $id)->first();

            if (!$aspiration) {
                return Response::buildErrorNotFound();
            }

            $assignment = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT)
                ->where('complaint_id', $aspiration->complaint_id)
                ->where('assigned_to', $toolsmanId)
                ->first();

            if (!$assignment) {
                return Response::buildError(403, 'You are not assigned to this task.');
            }

            $updateData = [
                'status' => $request->status,
                'feedback' => $request->feedback,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/aspirations'), $filename);
                $updateData['image'] = 'uploads/aspirations/' . $filename;
            }

            DB::table('aspirations')->where('id', $id)->update($updateData);

            DB::table(DatabaseConst::ASPIRATION_STATUS_LOG)->insert([
                'aspiration_id' => $id,
                'old_status' => $aspiration->status,
                'new_status' => $request->status,
                'note' => $request->feedback,
                'changed_by' => Auth::id(),
                'created_at' => now(),
            ]);

            DB::commit();
            LandingUsecase::clearCache();
            return Response::buildSuccess(message: 'Update progres berhasil disimpan.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Toolsman\AspirationUsecase::update - ' . $e->getMessage());
            return Response::buildErrorService($e->getMessage());
        }
    }
}
