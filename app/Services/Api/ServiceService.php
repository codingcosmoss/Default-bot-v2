<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\OneUserResource;
use App\Http\Resources\ServiceCategoryResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResources;
use App\Models\PersonalPrice;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ServiceService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Service::class;


    /**
     * @return mixed
     */
    public function index($data = null)
    {
        $items = $this->model::orderBy('order', 'asc')
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
            $item->name = $data['name'];
            $item->code = isset( $data['code']) ?  $data['code'] : '';
            $item->price = $data['price'];
            $item->name = $data['name'];
            $item->category_id = $data['category_id'];
            $item->material_price = $data['material_price'];
            $item->technic_price = $data['technic_price'];
            $item->order = $data['order'];
            $item->collection_id = isset($data['collection_id']) ? $data['collection_id'] : null;
            $item->status = $data['status'];


            if ($item->save()) {
                foreach ($data['personal_procents'] as $key => $value) {
                    $model = new PersonalPrice();
                    $model->employee_id = $value['employee_id'];
                    $model->service_id = $item->id;
                    $model->type = $value['type'];
                    $model->amount = $value['amount'];
                    $model->result_price = $value['result_price'];
                    $model->save();
                }
                DB::commit();
            }
             else {
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
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('name')->setRules('required|min:3|max:255'),
            TextField::make('code')->setRules('nullable|min:3|max:255'),
            TextField::make('price')->setRules('required|integer'),
            TextField::make('category_id')->setRules('required|integer'),
            TextField::make('material_price')->setRules('required|integer'),
            TextField::make('technic_price')->setRules('required|integer'),
            TextField::make('order')->setRules('required|integer'),
            TextField::make('status')->setRules('required|integer'),
            TextField::make('personal_procents')->setRules('nullable'),
            TextField::make('collection_id')->setRules('nullable|integer'),
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

            $item->name = $data['name'];
            $item->code = isset( $data['code']) ?  $data['code'] : '';
            $item->price = $data['price'];
            $item->category_id = $data['category_id'];
            $item->material_price = $data['material_price'];
            $item->technic_price = $data['technic_price'];
            $item->order = $data['order'];
            $item->collection_id = isset($data['collection_id']) ? $data['collection_id'] : null;
            $item->status = $data['status'];

            $deleteModels =  PersonalPrice::where('service_id', $id )->delete();
            if (isset($data['personal_procents'])){
                if (count($data['personal_procents']) > 0){
                    foreach ($data['personal_procents'] as $key => $value) {
                        $model = new PersonalPrice();
                        $model->employee_id = $value['employee_id'];
                        $model->service_id = $item->id;
                        $model->type = $value['type'];
                        $model->amount = $value['amount'];
                        $model->result_price = $value['result_price'];
                        $model->save();
                    }
                }


            }


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
            'data' => new ServiceResource($model)
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
                    'data' => new ServiceResource($item)
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

        $items = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('material_price', 'like', '%' . $key . '%')
                ->orWhere('technic_price', 'like', '%' . $key . '%');
        })
            ->orderBy($column, $sort)
            ->paginate($data['paginate']);

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
}
