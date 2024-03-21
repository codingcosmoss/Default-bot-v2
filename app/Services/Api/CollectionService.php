<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Resources\CollectionResorces;
use App\Http\Resources\FilialResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\TreatmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\Filial;
use App\Models\Group;
use App\Models\Treatment;
use App\Models\Warehouse;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CollectionService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Collection::class;
    protected $resource = CollectionResorces::class;

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
            TextField::make('products')->setRules('nullable'),
            TextField::make('product_total_sum')->setRules('nullable'),
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
            $model->name = $data['name'];
            $model->product_total_sum = isset($data['product_total_sum']) ? $data['product_total_sum'] : 0;

            if ($model->save()) {
                DB::commit();
                if (isset($data['products'])){
                    foreach ($data['products'] as $product){
                        $collectionProduct = new CollectionProduct();
                        $collectionProduct->collection_id = $model->id;
                        $collectionProduct->product_id = $product['id'];
                        $collectionProduct->amount = $product['amount'];
                        $collectionProduct->save();
                    }
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
        $model = $this->model::find($id);


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
            $model->product_total_sum = isset($data['product_total_sum']) ? $data['product_total_sum'] : 0;

            if ($model->save()) {
                DB::commit();
                if (isset($data['products'])){
                    $collectionProduct = CollectionProduct::where('collection_id', $model->id)
                        ->get();

                    foreach ($collectionProduct as $product){
                        $product->delete();
                    }

                    foreach ($data['products'] as $product){
                        $collectionProduct = new CollectionProduct();
                        $collectionProduct->collection_id = $model->id;
                        $collectionProduct->product_id = $product['id'];
                        $collectionProduct->amount = $product['amount'];
                        $collectionProduct->save();
                    }
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
        $sort = $data['order'] ?? 'asc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('name', 'like', '%' . $key . '%');
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
