<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Resources\CollectionResorces;
use App\Http\Resources\FilialResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\ProductDocumentResource;
use App\Http\Resources\TreatmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\Filial;
use App\Models\Group;
use App\Models\ImportedProduct;
use App\Models\ProductDocument;
use App\Models\Treatment;
use App\Models\Warehouse;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductDocumentService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = ProductDocument::class;
    protected $resource = ProductDocumentResource::class;

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
    public function getProducts($id)
    {

        $models = ImportedProduct::where('product_document_id', $id)
            ->join('products', 'imported_products.product_id', 'products.id')
            ->select('products.bar_code', 'products.name', 'products.size_type', 'imported_products.*')
            ->get();



        $data = [
            'items' => $models,
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
            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('description')->setRules('nullable'),
        ];
    }

    /**
     * @return array
     */
    public function importedProductsFields
    ()
    {
        return [
            TextField::make('product_document_id')->setRules('required|min:3|max:255'),
            TextField::make('product_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|integer'),
            TextField::make('price')->setRules('required|integer'),
        ];
    }


    public function importedProducts(array $data)
    {
        DB::beginTransaction();
        $document = ProductDocument::find($data['id']);
        $document->status = Status::$saved;
        $document->save();
        try {
            foreach ($data['products'] as $value){
                $model = new ImportedProduct();
                $model->product_document_id = $value['product_document_id'];
                $model->product_id = $value['id'];
                $model->amount = $value['amount'];
                $model->price = $value['price'];
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
            'data' => null
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
            $model->warehouse_id = $data['warehouse_id'];
            $model->supplier_id = $data['supplier_id'];
            $model->user_id = auth()->user()->id;
            $model->description = isset($data['description']) ? $data['description'] : null;

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
            $model->warehouse_id = $data['warehouse_id'];
            $model->supplier_id = $data['supplier_id'];
            $model->user_id = auth()->user()->id;
            $model->description = isset($data['description']) ? $data['description'] : null;
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
                ->orWhere('description', 'like', '%' . $key . '%');
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
