<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\Patient;
use App\Models\User;
use App\Traits\Status;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Patient::class;
    protected $resource = PatientResource::class;

    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $models = $this->model::orderBy('sort_order', 'asc')
            ->paginate($data['pages']);

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

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('first_name')->setRules('required|min:3|max:255'),
            TextField::make('last_name')->setRules('nullable|min:3|max:255'),
            TextField::make('phone')->setRules('nullable|numeric'),
            TextField::make('job')->setRules('nullable|min:3|max:255'),
            TextField::make('address')->setRules('nullable|min:3|max:255'),
            TextField::make('gender')->setRules('required|integer'),
            TextField::make('birthday')->setRules('nullable'),
            TextField::make('price')->setRules('nullable|integer'),
            TextField::make('sort_order')->setRules('nullable:integer'),
            TextField::make('diseasesIds')->setRules('nullable'),
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
            $model = new $this->model;
            $model->first_name = $data['first_name'];
            $model->last_name = $data['last_name'];
            $model->phone = $data['phone'];
            $model->job = $data['job'];
            $model->address = $data['address'];
            $model->gender = $data['gender'];
            $model->birthday = $data['birthday'];
            $model->price = $data['price'];
            $model->status = Status::$status_active;

            if ($model->save()) {
                DB::commit();
                if ($data['diseasesIds'] != 0){
                    $model->diseases()->attach( $data['diseasesIds']);
                }
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
        $model = $this->model::where('status', Status::$status_active)
            ->where('id', $id)
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

            $model->first_name = $data['first_name'];
            $model->last_name = $data['last_name'];
            $model->phone = $data['phone'];
            $model->job = $data['job'];
            $model->address = $data['address'];
            $model->gender = $data['gender'];
            $model->birthday = $data['birthday'];
            $model->price = $data['price'];
            $model->status = Status::$status_active;


            if ($model->save()) {
                DB::commit();
                $model->diseases()->detach();
                if ($data['diseasesIds'] != 0){
                    $model->diseases()->attach( $data['diseasesIds']);
                }

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

            $model->delete();

            if ($model->save()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' =>  new $this->resource($model)
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
        $sort = $data['order'] ?? 'asc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->orWhere('first_name', 'like', '%' . $key . '%')
                ->orWhere('last_name', 'like', '%' . $key . '%')
                ->orWhere('phone', 'like', '%' . $key . '%')
                ->orWhere('job', 'like', '%' . $key . '%')
                ->orWhere('address', 'like', '%' . $key . '%');
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
