<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientShowResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use App\Traits\Status;
use Carbon\Carbon;
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

    public function getAttachFields()
    {
        return [
            TextField::make('start')->setRules('required|date'),
            TextField::make('hour')->setRules('required|integer'),
            TextField::make('user_id')->setRules('required|numeric'),
            TextField::make('patient_id')->setRules('required|numeric'),
            TextField::make('reception_description')->setRules('nullable'),

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
            $model->sort_order = $data['sort_order'];
            $model->birthday = $data['birthday'];
            $model->price = $data['price'];
            $model->status = Status::$status_active;

            if ($model->save()) {
                DB::commit();
                if ($data['diseasesIds'] != 0) {
                    $model->diseases()->attach($data['diseasesIds']);
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

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function joinDr(array $data)
    {
        $fields = $this->getAttachFields();

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

        // // Berilgan vaqt
        // $time = $data['hour'];

        // // Vaqtning soat va daqiqa bo'linishi
        // list($hours, $minutes) = explode(':', $time);

        // // Vaqtni minutga o'tkazish
        // $totalMinutes = ($hours * 60) + $minutes;

        // Carbon klasidan foydalanib, berilgan vaqtni obyektga aylantiramiz
        $carbonStart = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($data['start'])));

        // 1800 daqiqa (30 soat) qo'shamiz
        $end = $carbonStart->addMinutes($data['hour'])->toDateTimeString();


        DB::beginTransaction();
        try {

            $model = new Treatment();
            $model->user_id = $data['user_id'];
            $model->patient_id = $data['patient_id'];
            $model->start = date('Y-m-d H:i', strtotime($data['start']));
            $model->end =  date('Y-m-d H:i', strtotime($end));
            $model->reception_description = $data['reception_description'];
            $model->status = Status::$new;
            $model->payment_status = Status::$unpaid;


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
            $model->last_name = isset($data['last_name']) ? $data['last_name'] : '';
            $model->phone = isset($data['phone']) ? $data['phone'] : '';
            $model->job =  isset($data['job']) ? $data['job'] : '';
            $model->address = isset($data['address']) ? $data['address'] : '';
            $model->gender = $data['gender'];
            $model->birthday = isset($data['birthday']) ? $data['birthday'] : '';
            $model->sort_order = isset($data['sort_order']) ? $data['sort_order'] : '';
            $model->price = isset($data['price']) ? $data['price'] : '';
            $model->status = Status::$status_active;


            if ($model->save()) {
                DB::commit();
                $model->diseases()->detach();
                if ($data['diseasesIds'] != 0) {
                    $model->diseases()->attach($data['diseasesIds']);
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

        if (!$model) {
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
            'data' => new PatientShowResource($model)
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
