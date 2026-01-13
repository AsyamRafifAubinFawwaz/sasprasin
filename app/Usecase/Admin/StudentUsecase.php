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

class StudentUsecase extends Usecase
{
   public function getAll(array $filterData = []): array
{
    try {
        $query = DB::table(DatabaseConst::STUDENT . ' as s')
            ->join(DatabaseConst::USER . ' as u', 's.user_id', '=', 'u.id')
            ->leftJoin(DatabaseConst::CLASSROOM . ' as c', 's.classroom_id', '=', 'c.id')
            ->whereNull('s.deleted_at')
            ->select(
                's.id',
                's.classroom_id',
                's.nisn',
                'u.name',
                'u.email',
                'c.class_name as display_class', 
                's.created_at'
            )
            ->when($filterData['keywords'] ?? false, function ($query, $keywords) {
                return $query->where('u.name', 'like', '%' . $keywords . '%');
            })
            ->when($filterData['classroom_id'] ?? false, function ($query, $classroomId) {
                return $query->where('s.classroom_id', $classroomId);
            })
            ->orderBy('s.created_at', 'desc');

        if (! empty($filterData['no_pagination'])) {
            $data = $query->get();
        } else {
            $data = $query->paginate(20);

            if (! empty($filterData)) {
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
             'nisn' => 'required|int',
             'classroom_id' => 'required|exists:classrooms,id',
         ]);

         $validator->validate();

         DB::beginTransaction();
         try {
             $adminId = Auth::user()?->id;

             // 1. CREATE USER (SISWA)
             $userId = DB::table(DatabaseConst::USER)->insertGetId([
                 'name' => $data->name,
                 'email' => $data->email,
                 'password' => Hash::make('asdasd'),
                 'access_type' => 2,
                 'created_at' => now(),
             ]);

             DB::table(DatabaseConst::STUDENT)->insert([
                 'user_id' => $userId,
                 'classroom_id' => $data->classroom_id,
                 'nisn' => $data->nisn,
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

            $data = DB::table(DatabaseConst::STUDENT . ' as s')
                ->join(DatabaseConst::USER . ' as u', 's.user_id', '=', 'u.id')
                ->whereNull('s.deleted_at')
                ->where('s.id', $id)
                ->select(
                    's.*',
                    'u.name',
                    'u.email'
                )
                ->first();

            if (!$data) {
                return Response::buildErrorNotFound('Data siswa tidak ditemukan');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'classroom_id' => 'required|exists:classrooms,id',
            'nisn' => 'required|int',
        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            $student = DB::table(DatabaseConst::STUDENT)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$student) {
                throw new Exception('Data siswa tidak ditemukan');
            }

            DB::table(DatabaseConst::USER)
                ->where('id', $student->user_id)
                ->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'updated_at' => now(),
                ]);

            DB::table(DatabaseConst::STUDENT)
                ->where('id', $id)
                ->update([
                    'classroom_id' => $data->classroom_id,
                    'nisn' => $data->nisn,
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
            $student = DB::table(DatabaseConst::STUDENT)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (!$student) {
                throw new Exception('Data siswa tidak ditemukan');
            }

            DB::table(DatabaseConst::USER)
                ->where('id', $student->user_id)
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
            DB::table(DatabaseConst::STUDENT)
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
}
