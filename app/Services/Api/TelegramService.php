<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientShowResource;
use App\Http\Resources\TelegramResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\Patient;
use App\Models\Telegram;
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

class TelegramService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Telegram::class;
    protected $resource = TelegramResource::class;

    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $models = $this->model::orderBy('updated_at', 'desc')
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
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('telegram_id')->setRules('required|numeric')
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
            $hasId = $this->model::where('telegram_id', $data['telegram_id'] )->first();
            if ($hasId){
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 200,
                    'data' => [
                        'telegram_id' => 'The id number must not be the same'
                    ]
                ];
            }

            $model = new $this->model;
            $model->name = $data['name'];
            $model->telegram_id = $data['telegram_id'];

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
        $model = $this->model::find($id);

        if (!$model) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];
        }


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
            $model->telegram_id = $data['telegram_id'];

            if ($model->save()) {
                DB::commit();
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => $model
                ];
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


            if ($model->delete()) {
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
        $column = $data['column'] ?? 'updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('telegram_id', 'like', '%' . $key . '%');
        })
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
