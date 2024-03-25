<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\PersonalServiceResource;
use App\Http\Resources\ServiceResource;
use App\Models\PersonalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PersonalServicesService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = PersonalService::class;


    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $items = $this->model::orderBy('created_at', 'asc')
            ->paginate($data['pages']);

        $data = [
            'items' => ServiceResource::collection($items),
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('user_id')->setRules('required|integer'),
            TextField::make('service_id')->setRules('required|integer'),
            TextField::make('percent')->setRules('required|integer'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }




    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function store(array $data)
    {

        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 200,
                'data' => $errors
            ];
        }

        $data = $validator->validated();

        DB::beginTransaction();
        try {
            $item = new $this->model;
            $item->user_id = $data['user_id'];
            $item->service_id = $data['service_id'];
            $item->percent = $data['percent'];
            $item->status = $data['status'];

            if ($item->save()) {
                DB::commit();

            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 200,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 200,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $item
        ];
    }




    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {

        $item = $this->model::where('id', $id)
            ->first();

        if (!$item) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];

        }

//        if ($item->role != User::$role_doctor) {
//            return [
//                'status' => false,
//                'message' => "Siz noto'g'ri apiga ma'lumot yuboryabsiz!",
//                'statusCode' => 403,
//                'data' => null
//            ];
//        }

        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 403,
                'data' => $errors
            ];
        }

        DB::beginTransaction();
        try {

            $item->user_id = $data['user_id'];
            $item->service_id = $data['service_id'];
            $item->percent = $data['percent'];
            $item->status = $data['status'];

            if ($item->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }

        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $item
        ];
    }



    /**
     * @param $id
     * @return UserResource|mixed
     */
    public function show($id)
    {
        $model = $this->model::find($id);

        if (!$model){
            return [
                'status' => false,
                'message' => 'Staff not found',
                'statusCode' => 403,
                'data' => null
            ];
        }
        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => new PersonalServiceResource($model)
        ];

    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $item = $this->model::find($id);
        if ($item) {

            $item->delete();

            if ($item->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => new PersonalServiceResource($item)
                ];
            }
        }
        return [
            'status' => false,
            'message' => 'There was a problem deleting',
            'statusCode' => 403,
            'data' => null
        ];
    }



    /**
     * @param array $data
     * @return array
     */
    public function search(array $data)
    {
        $column = $data['column'] ?? 'sort_order';
        $sort = $data['order'] ?? 'desc';

        $items = $this->model::orderBy($column, $sort)
            ->paginate($data['paginate']);

        $data = [
            'items' => PersonalServiceResource::collection($items),
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }
}
