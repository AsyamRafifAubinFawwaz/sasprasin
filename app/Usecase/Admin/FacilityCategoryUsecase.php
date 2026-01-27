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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FacilityCategoryUsecase extends Usecase
{
    public function getAll(array $filterData = []): array
    {
        try {
            $query = DB::table(DatabaseConst::FACILITY_CATEGORY)
                ->whereNull('deleted_at')
                ->when($filterData['keywords'] ?? false, function ($query, $keywords) {
                    return $query->where('name', 'like', '%'.$keywords.'%')
                        ->where('priority', 'like', '%'.$keywords.'%')
                        ->where('example_items', 'like', '%'.$keywords.'%');
                })
                ->when($filterData['priority_level'] ?? false, function ($query, $priorityLevel) {
                    return $query->where('priority', '=', $priorityLevel);
                })
                ->orderBy('created_at', 'asc');

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
            'priority' => 'required|int',
            'example_items' => 'required|string',

        ]);

        $validator->validate();

        DB::beginTransaction();
        try {
            $payload = $data->only(['name', 'priority', 'example_items']);
            $payload['created_by'] = Auth::user()?->id;
            $payload['created_at'] = now();
            $payload['updated_at'] = now();

            DB::table(DatabaseConst::FACILITY_CATEGORY)->insert($payload);

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
            $data = DB::table(DatabaseConst::FACILITY_CATEGORY)
                ->where('id', $id)
                ->whereNull('deleted_at')
                ->first();

            if (! $data) {
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
            'name' => 'required|string|max:255',
            'priority' => 'required|int',
            'example_items' => 'required|string',

        ]);

        $validator->validate();

        $update = [
            'name' => $data['name'],
            'priority' => $data['priority'],
            'example_items' => $data['example_items'],
            'updated_by' => Auth::user()?->id,
            'updated_at' => now(),
        ];
        DB::beginTransaction();
        try {
            DB::table(DatabaseConst::FACILITY_CATEGORY)
                ->where('id', $id)
                ->update($update);
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
            DB::table(DatabaseConst::FACILITY_CATEGORY)
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
