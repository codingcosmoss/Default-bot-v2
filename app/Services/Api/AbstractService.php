<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Traits\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class AbstractService
{
    protected $model;
    protected $resource;
    protected $menu;
    protected $isClinic = false; // Clinikalarga bog'liqmi yoki yo'qmi
    protected $columns = [];

    public function index()
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            if ($this->isClinic){
                $data = $this->resource::collection(
                    $this->model::where('clinic_id', auth()->user()->clinic_id)
                        ->get()
                );
            }else{
                $data = $this->resource::collection($this->model::all());
            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }
    public function getPaginate($count = 10)
    {

        try {

            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            if ($this->isClinic){
                $models = $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->orderBy('id', 'asc')
                    ->paginate($count);
            }else{
                $models = $this->model::orderBy('id', 'asc')
                    ->paginate($count);
            }


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
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function orderBy($column = 'id', $type = 'desc')
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            if($this->isClinic){
                $data = $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->orderBy($column, $type)
                    ->get();
            }else{
                $data = $this->model::orderBy($column, $type)->get();
            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function activeIndex()
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            if($this->isClinic){
                $data = $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->where('status', Status::$status_active)->get();
            }else{
                $data = $this->model::where('status', Status::$status_active)->get();
            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function show($id)
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            if ($this->isClinic){
                $data = $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->where('id', $id)
                    ->first();
            }else{
                $data =  $this->model::find($id);
            }

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($data)
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function store(array $data)
    {
        try {
            if (!$this->hasPermission('create')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            $validator = $this->dataValidator($data, $this->storeFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $object = new $this->model;
            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($object)
            ];


        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }
    public function update(array $data, $id)
    {
        try {
            if (!$this->hasPermission('update')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            $item = $this->model::find($id);
            $validator = $this->dataValidator($data, $this->updateFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }
            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;

            foreach ($this->updateFields() as $field) {
                $field->fill($item, $data);
            }
            $item->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($item)
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function search($search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        if ($this->isClinic){
            $data = $this->model::where(function ($query) use ($search) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
                ->where('clinic_id', auth()->user()->clinic_id)
                ->limit(10)
                ->get();
        }else{
            $data = $this->model::where(function ($query) use ($search) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
                ->limit(10)
                ->get();
        }

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $this->resource::collection($data)
        ];
    }
    public function destroy($id)
    {
        try {
            if (!$this->hasPermission('delete')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $item = $this->model::find($id);
            $item->delete($id);
            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $item
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    // ------------------ Additional functions -------------------------------------------
    public function dataValidator($data, $fields)
    {
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field->getName()] = $field->getRules();
        }
        $validator = Validator::make($data, $rules);

        if ($validator->fails()){
            $errors = [];
            foreach ($validator->errors()->getMessages() as $key => $value) {
                $errors[$key] = $value[0];
            }
            return [
                'status' => $validator->fails(),
                'validator' => $errors
            ];
        }
        return [
            'status' => $validator->fails(),
            'data' =>  $validator->validated(),
            'validator' => $validator
        ];

    }
    public function validator($fields, $data)
    {
        $error = null;
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

            $error =  [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 200,
                'data' => $errors
            ];
        }

        if ($error != null){
            return [
                'error' => true,
                'data' => null,
                'message' => $error
            ];
        }
        return [
            'error' => false,
            'data' => $validator->validated()
        ];
    }
    public function storeFields()
    {
        return [
            TextField::make('column')->setRules('required|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('column')->setRules('required|string'),
        ];
    }
    public function imageFields()
    {
        return [
            TextField::make('image')->setRules('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048'),
        ];
    }
    public function documentFields()
    {
        return [
            TextField::make('image')->setRules('nullable|file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx|max:10048'),
        ];
    }
    public function sendResponse(bool $status = true, string $message = 'success', int $statusCode = 200, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data
        ];
    }
    public function uploadImages($model, $file)
    {

        if ($file->hasFile('images')) {
            $arxivImages = $model->images; // O'chirishni istagan faylning nomi
            if ($arxivImages != null) {
                foreach ($arxivImages as $arxivImage){
                    Storage::disk('public')->delete($arxivImage->url);
                }
                $model->images()->delete();
            }

            $images = $file->file('images');
            foreach ($images as $image){
                $path = $image->store('images', 'public'); // 'images' papkasi ichiga saqlaydi
                $newImage = new Image();
                $newImage->url = $path;
                $model->images()->save($newImage);

            }
        }
        return true;
    }
    public function uploadImagesOne($model, $file)
    {

        if ($file->hasFile('image')) {
            $arxivImages = $model->image; // O'chirishni istagan faylning nomi
            if ($arxivImages != null) {
                foreach ($arxivImages as $arxivImage){
                    Storage::disk('public')->delete($arxivImage->url);
                }
                $model->image()->delete();
            }

            $image = $file->file('image');
            $path = $image->store('images', 'public'); // 'images' papkasi ichiga saqlaydi
            $newImage = new Image();
            $newImage->url = $path;
            $model->image()->save($newImage);

        }
        return true;
    }

    public function hasPermission($name)
    {
        if ($this->menu == 'public'){
            return true;
        }

        $isPermission = RolePermission::where('role_id', auth()->user()->role_id)
                ->where('permission_name', $this->menu.'-'.$name )
                ->first();

        return $isPermission;

    }
}
