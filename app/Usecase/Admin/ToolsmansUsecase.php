<?php

namespace App\Usecase\Admin;

use App\Constants\DatabaseConst;
use App\Constants\ResponseConst;
use App\Http\Presenter\Response;
use App\Usecase\Usecase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ToolsmansUsecase extends Usecase
{
    public function getAll(array $filterData = []): array
    {
        try {
            $query = DB::table(DatabaseConst::TOOLSMAN . ' as s')
                ->join(DatabaseConst::USER . ' as u', 's.user_id', '=', 'u.id')
                ->whereNull('s.deleted_at')
                ->select(
                    's.id',
                    's.phone',
                    's.skill',
                    'u.name',
                    'u.email',
                    's.created_at',
                    DB::raw('(
                        SELECT COUNT(*) FROM ' . DatabaseConst::COMPLAINT_ASSIGNMENT . ' ca
                        JOIN ' . DatabaseConst::ASPIRATION . ' a ON ca.complaint_id = a.complaint_id
                        WHERE ca.assigned_to = s.id
                        AND a.status = ' . \App\Constants\ProgressConst::IN_PROGRESS . '
                    ) as active_tasks'),
                    DB::raw('(
                        SELECT COUNT(*) FROM ' . DatabaseConst::COMPLAINT_ASSIGNMENT . ' ca
                        WHERE ca.assigned_to = s.id
                    ) as total_tasks')
                )
                ->when($filterData['keywords'] ?? false, function ($query, $keywords) {
                    $query->where(function ($q) use ($keywords) {
                        $q->where('u.name', 'like', "%{$keywords}%")
                            ->orWhere('s.phone', 'like', "%{$keywords}%");
                    });
                })
                ->orderByDesc('active_tasks')
                ->orderBy('s.created_at', 'desc');

            if (!empty($filterData['no_pagination'])) {
                $data = $query->get();
            } else {
                $data = $query->paginate(8);

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            $adminId = Auth::user()?->id;

            $userId = DB::table(DatabaseConst::USER)->insertGetId([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make('asdasd'),
                'access_type' => 3,
                'created_at' => now(),
            ]);

            DB::table(DatabaseConst::TOOLSMAN)->insert([
                'user_id' => $userId,
                'phone' => $data->phone,
                'skill' => $data->skill,
                'created_by' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return Response::buildSuccessCreated();
        } catch (Exception $e) {
            DB::rollback();

            Log::error($e->getMessage(), ['method' => __METHOD__]);

            return Response::buildErrorService($e->getMessage());
        }
    }

    public function getById(int $id): array
    {
        try {
            $data = DB::table(DatabaseConst::TOOLSMAN . ' as s')
                ->join(DatabaseConst::USER . ' as u', 's.user_id', '=', 'u.id')
                ->whereNull('s.deleted_at')
                ->where('s.id', $id)
                ->select('s.*', 'u.name', 'u.email')
                ->first();

            if (!$data) {
                return Response::buildErrorNotFound('Data petugas tidak ditemukan');
            }

            $tasks = DB::table(DatabaseConst::COMPLAINT_ASSIGNMENT . ' as ca')
                ->join(DatabaseConst::COMPLAINT . ' as c', 'ca.complaint_id', '=', 'c.id')
                ->leftJoin(DatabaseConst::ASPIRATION . ' as a', 'c.id', '=', 'a.complaint_id')
                ->leftJoin('facility_categories as fc', 'c.facility_category_id', '=', 'fc.id')
                ->leftJoin('locations as l', 'c.location_id', '=', 'l.id')
                ->leftJoin(DatabaseConst::USER . ' as student', 'c.student_id', '=', 'student.id')
                ->where('ca.assigned_to', $id)
                ->select(
                    'c.id',
                    'student.name as student_name',
                    'c.description',
                    'fc.name as category_name',
                    'fc.priority',
                    'l.name as location',
                    'a.status',
                    'ca.assigned_at'
                )
                ->orderByDesc('ca.assigned_at')
                ->get();

            return Response::buildSuccess(
                ['data' => $data, 'tasks' => $tasks],
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'phone' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            $toolsman = DB::table(DatabaseConst::TOOLSMAN)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$toolsman) {
                throw new Exception('Data petugas tidak ditemukan');
            }

            DB::table(DatabaseConst::USER)
                ->where('id', $toolsman->user_id)
                ->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'updated_at' => now(),
                ]);

            DB::table(DatabaseConst::TOOLSMAN)
                ->where('id', $id)
                ->update([
                    'phone' => $data->phone,
                    'skill' => $data->skill,
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

    public function resetPassword(int $id): array
    {
        DB::beginTransaction();
        try {
            $toolsman = DB::table(DatabaseConst::TOOLSMAN)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$toolsman) {
                throw new Exception('Data petugas tidak ditemukan');
            }

            DB::table(DatabaseConst::USER)
                ->where('id', $toolsman->user_id)
                ->update([
                    'password' => Hash::make('asdasd'),
                    'updated_at' => now(),
                ]);

            DB::commit();

            return Response::buildSuccess(
                message: 'Password berhasil diperbarui'
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
            $toolsman = DB::table(DatabaseConst::TOOLSMAN)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$toolsman) {
                throw new Exception('Data petugas tidak ditemukan');
            }

            DB::table(DatabaseConst::TOOLSMAN)
                ->where('id', $id)
                ->update([
                    'deleted_by' => Auth::user()?->id,
                    'deleted_at' => now(),
                ]);

            DB::table(DatabaseConst::USER)
                ->where('id', $toolsman->user_id)
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
}
