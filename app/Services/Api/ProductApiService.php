<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Resources\FilialResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TreatmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Filial;
use App\Models\Product;
use App\Models\Treatment;
use App\Models\Warehouse;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductApiService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Product::class;
    protected $resource = ProductResource::class;

    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $models = $this->model::orderBy('updated_at', 'desc')
            ->paginate(5);

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
    public function indexAll($data = null)
    {

        $models = $this->model::orderBy('updated_at', 'desc')
            ->get();

        $data = [
            'items' => $this->resource::collection($models),
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
            TextField::make('brand_id')->setRules('required|integer'),
            TextField::make('image')->setRules('required|image|mimes:jpeg,png,jpg,gif,svg|max:5048'),
            TextField::make('tegs')->setRules('required|string'),
            TextField::make('description_uz')->setRules('required|string'),
            TextField::make('description_ru')->setRules('required|string'),
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
            $model->brand_id = $data['brand_id'];
            $model->tegs = $data['tegs'];
            $model->description_uz = $data['description_uz'];
            $model->description_ru = $data['description_ru'];

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

            $model->brand_id = $data['brand_id'];
            $model->tegs = $data['tegs'];
            $model->description_uz = $data['description_uz'];
            $model->description_ru = $data['description_ru'];


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
        $column = $data['column'] ?? 'updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('name', 'like', '%' . $key . '%')
                ->orWhere('bar_code', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('vendor_code', 'like', '%' . $key . '%')
                ->orWhere('group_id', 'like', '%' . $key . '%')
                ->orWhere('size_type', 'like', '%' . $key . '%');
        })
            ->orderBy($column, $sort)
            ->paginate(5);

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
