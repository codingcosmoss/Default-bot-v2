<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\CompanySettingResource;
use App\Http\Resources\DiseaseResource;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\CompanySetting;
use App\Models\Disease;
use App\Models\Patient;
use App\Models\User;
use App\Traits\Status;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingService extends AbstractService
{

    /**
     * @return mixed
     */
    public function companyShow($data = null)
    {

        $model = CompanySetting::first();

        $data = [
            'items' => new CompanySettingResource($model),
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
    public function getCompanyFields()
    {
        return [
            TextField::make('name')->setRules('nullable'),
            TextField::make('phone1')->setRules('nullable'),
            TextField::make('phone2')->setRules('nullable'),
            TextField::make('email')->setRules('nullable'),
            TextField::make('address')->setRules('nullable'),
            TextField::make('bot_token')->setRules('nullable'),
            TextField::make('printer_size')->setRules('nullable:integer')
        ];
    }


    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function companyStore(array $data)
    {



        $fields = $this->getCompanyFields();

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
            $model = CompanySetting::first();
            if (!$model){
                $model = new CompanySetting();
            }
            $model->name = isset($data['name']) ? $data['name'] : 'Company name';
            $model->phone1 = isset($data['phone1']) ? $data['phone1'] : 9989;
            $model->phone2 = isset($data['phone2']) ? $data['phone2'] : 9989;
            $model->email = isset($data['email']) ? $data['email'] : null;
            $model->address = isset($data['address']) ? $data['address'] : null;
            $model->bot_token = isset($data['bot_token']) ? $data['bot_token'] : null;
            $model->printer_size = isset($data['printer_size']) ? $data['printer_size'] : null;

            if ($model->save()) {
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
            'data' => $model
        ];
    }


    //<editor-fold desc="Edit">
    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {

        $model = $this->model::where('id', $id)
            ->first();

        if (!$model) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];

        }

//        if ($model->role != User::$role_doctor) {
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

            $model->name = $data['name'];
            $model->color = $data['color'];
            $model->status = $data['status'] == 'true' ? Status::$status_active :  Status::$status_inactive;



            if ($model->save()) {
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
            'data' => $model
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
            'data' => new $this->resource($model)
        ];

    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model::find($id);
        if ($model) {

            if ($model->status == Status::$status_deleted) {

                return [
                    'status' => false,
                    'message' => 'User deleted',
                    'statusCode' => 403,
                    'data' => null
                ];
            }

            $model->status = Status::$status_deleted;
            $model->delete();

            if ($model->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' =>  null
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
        $key = $data['search'] ?? '';
        $column = $data['column'] ?? 'sort_order';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('name', 'like', '%' . $key . '%');
        })
            ->where('status', '!=', Status::$status_deleted)
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

        $data = [
            'items' => $this->resource::collection($models),
            'pagination' => [
                'total' => $models->total(),
                'per_page' => $models->perPage(),
                'current_page' => $models->currentPage(),
                'last_page' => $models->lastPage(),
                'from' => $models->firstItem(),
                'to' => $models->lastItem(),
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
