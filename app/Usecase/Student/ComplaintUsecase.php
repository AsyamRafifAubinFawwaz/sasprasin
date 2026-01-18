<?php

namespace App\Usecase\Student;

use App\Constants\DatabaseConst;
use App\Constants\ProgressConst;
use App\Constants\ResponseConst;
use App\Http\Presenter\Response;
use App\Usecase\Usecase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ComplaintUsecase extends Usecase
{
    public function getAll(array $filterData = []): array
    {
        try {
            $query = DB::table(DatabaseConst::COMPLAINT)
                ->join('facility_categories', 'complaints.category_id', '=', 'facility_categories.id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select('complaints.*', 'facility_categories.name as category_name', 'aspirations.status as aspiration_status', 'aspirations.feedback as aspiration_feedback')
                ->whereNull('complaints.deleted_at')
                ->when($filterData['keywords'] ?? false, function ($query, $keywords) {
                    return $query->where('description', 'like', '%' . $keywords . '%')
                        ->orWhere('location', 'like', '%' . $keywords . '%');
                })
                ->when($filterData['category_id'] ?? false, function ($query, $categoryId) {
                    return $query->where('category_id', '=', $categoryId);
                })
                ->when($filterData['student_id'] ?? false, function ($query, $studentId) {
                    return $query->where('student_id', '=', $studentId);
                })
                ->orderBy('complaints.created_at', 'desc');

            if (!empty($filterData['no_pagination'])) {
                $data = $query->get();
            } else {
                $data = $query->paginate(20);

                if (!empty($filterData)) {
                    $data->appends($filterData);
                }
            }

            return Response::buildSuccess(
                [
                    'list' => $data,
                ],
                ResponseConst::HTTP_SUCCESS
            );
        } catch (Exception $e) {
            Log::error(
                message: $e->getMessage(),
                context: [
                    'method' => __METHOD__,
                ]
            );

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function create(Request $data): array
    {
        $validator = Validator::make($data->all(), [
            'student_id' => 'required|integer|exists:users,id',
            'facility_category_id' => 'required|integer|exists:facility_categories,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            $payload = $data->only(['student_id', 'facility_category_id', 'description', 'location']);
            $payload['created_by'] = Auth::user()?->id ?? 0;
            $payload['created_at'] = now();
            $payload['updated_at'] = now();

            // Handle file upload
            if ($data->hasFile('image')) {
                $file = $data->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/complaints'), $filename);
                $payload['image'] = 'uploads/complaints/' . $filename;
            }

            $complaintId = DB::table('complaints')->insertGetId($payload);

            // Insert ke aspirations table dengan status Pending
            DB::table('aspirations')->insert([
                'complaint_id' => $complaintId,
                'status' => ProgressConst::PENDING,
                'feedback' => null,
                'created_by' => Auth::user()?->id ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return Response::buildSuccessCreated();
        } catch (Exception $e) {
            DB::rollback();

            Log::error(
                message: $e->getMessage(),
                context: [
                    'method' => __METHOD__,
                ]
            );

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getById(int $id): array
    {
        try {
            $data = DB::table('complaints')
                ->join('facility_categories', 'complaints.facility_category_id', '=', 'facility_categories.id')
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select('complaints.*', 'facility_categories.name as category_name', 'aspirations.status as aspiration_status', 'aspirations.feedback as aspiration_feedback')
                ->where('complaints.id', $id)
                ->whereNull('complaints.deleted_at')
                ->first();

            if (!$data) {
                return Response::buildErrorService(ResponseConst::ERROR_MESSAGE_NOT_FOUND);
            }

            return Response::buildSuccess(
                ['data' => $data],
                ResponseConst::HTTP_SUCCESS
            );
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['method' => __METHOD__]);
            return Response::buildErrorService($e->getMessage());
        }
    }

    public function update(Request $data, int $id): array
    {
        $validator = Validator::make($data->all(), [
            'facility_category_id' => 'required|integer|exists:facility_categories,id',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validator->validate();

        $update = [
            'facility_category_id' => $data['facility_category_id'],
            'description' => $data['description'],
            'location' => $data['location'],
            'updated_by' => Auth::user()?->id,
            'updated_at' => now(),
        ];

        // Handle file upload
        if ($data->hasFile('image')) {
            $file = $data->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/complaints'), $filename);
            $update['image'] = 'uploads/complaints/' . $filename;
        }

        DB::beginTransaction();
        try {
            DB::table('complaints')
                ->where('id', $id)
                ->update($update);

            // Update aspirations table
            DB::table('aspirations')
                ->where('complaint_id', $id)
                ->update([
                    'updated_by' => Auth::user()?->id,
                    'updated_at' => now(),
                ]);

            DB::commit();

            return Response::buildSuccess(
                message: ResponseConst::SUCCESS_MESSAGE_UPDATED
            );
        } catch (Exception $e) {
            DB::rollback();

            Log::error($e->getMessage(), ['method' => __METHOD__]);
            return Response::buildErrorService($e->getMessage());
        }
    }

    public function delete(int $id): array
    {
        DB::beginTransaction();
        try {
            DB::table('complaints')
                ->where('id', $id)
                ->update([
                    'deleted_by' => Auth::user()?->id,
                    'deleted_at' => now(),
                ]);

            DB::commit();

            return Response::buildSuccess(
                message: ResponseConst::SUCCESS_MESSAGE_DELETED
            );
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage(), ['method' => __METHOD__]);
            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getByStudentId(int $studentId, array $filterData = []): array
    {
        try {
            $query = DB::table('complaints')
                ->join(
                    'facility_categories',
                    'complaints.facility_category_id',
                    '=',
                    'facility_categories.id'
                )
                ->leftJoin('aspirations', 'complaints.id', '=', 'aspirations.complaint_id')
                ->select('complaints.*', 'facility_categories.name as category_name', 'aspirations.status as aspiration_status', 'aspirations.feedback as aspiration_feedback')
                ->where('complaints.student_id', $studentId)
                ->whereNull('complaints.deleted_at')
                ->orderBy('complaints.created_at', 'desc');


            if (!empty($filterData['no_pagination'])) {
                $data = $query->get();
            } else {
                $data = $query->paginate(20);

                if (!empty($filterData)) {
                    $data->appends($filterData);
                }
            }

            return Response::buildSuccess(
                ['list' => $data],
                ResponseConst::HTTP_SUCCESS
            );
        } catch (Exception $e) {
            Log::error($e->getMessage(), ['method' => __METHOD__]);
            return Response::buildErrorService($e->getMessage());
        }
    }
}
