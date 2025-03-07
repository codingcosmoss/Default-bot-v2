<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\UserResources;
use App\Models\ClinicUser;
use App\Models\Notification;
use App\Models\User;
use App\Traits\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Token\Stack;


class UserService extends AbstractService
{
    protected $model = User::class;
    protected $resource = UserResources::class;
    protected $columns = ['name', 'position', 'login'];
    protected $menu = 'Employees';
    protected $isClinic = true;

    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('login')->setRules('required|string|min:5'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('role_id')->setRules('required|integer'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('management')->setRules('nullable'),
            TextField::make('email')->setRules('nullable'),
            TextField::make('position')->setRules('nullable'),
            TextField::make('password')->setRules('required|min:5'),
            TextField::make('payable')->setRules('numeric|required'),
            TextField::make('due')->setRules('integer|required'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('login')->setRules('required|string|min:5'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('role_id')->setRules('required|integer'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('management')->setRules('nullable'),
            TextField::make('email')->setRules('nullable'),
            TextField::make('position')->setRules('nullable'),
            TextField::make('payable')->setRules('numeric|required'),
            TextField::make('due')->setRules('integer|required'),
        ];
    }

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

            $data = $this->resource::collection(
                $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->where('private', Status::$status_inactive)
                    ->get()
            );

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

            $models = $this->model::where('clinic_id', auth()->user()->clinic_id)
                ->where('private', Status::$status_inactive)
                ->orderBy('id', 'asc')
                ->paginate($count);

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

    public function profileUpdateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('login')->setRules('required|string|min:5'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('management')->setRules('nullable'),
            TextField::make('email')->setRules('nullable'),
        ];
    }

    public function updatePasswordFields()
    {
        return [
            TextField::make('password')->setRules('required|min:5'),
        ];
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
                'data' => new AuthUserResource($data)
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
    public function changePassword($data, $id)
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

            $validator = $this->dataValidator($data, $this->updatePasswordFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }
            $data = $validator['data'];
            $user = $this->model::find($id);
            $user->password = Hash::make($data['password']);
            $user->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $user
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
    public function store(array $data, $image = null)
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
            $imageValidator = $this->dataValidator($data, $this->imageFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $isLogin = $this->model::where('login', $data['login'])->first();
            if ($isLogin){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'This login name is busy',
                    'errors' => ['login'=> 'This login name is busy']
                ];
            }
            $object = new $this->model;
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['management'] = Status::$admin_panel;


            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save();
            if (!$imageValidator['status']) {
                $this->uploadImagesOne($object, $image);
            }

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
    public function update(array $data, $id, $image = null)
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
            $imageValidator = $this->dataValidator($data, $this->imageFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }
            if (!$imageValidator['status']) {
                $this->uploadImagesOne($item, $image);
            }

            $data = $validator['data'];
            $isLogin = $this->model::where('login', $data['login'])->first();
            if ($isLogin && $isLogin->id != $id){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'This login name is busy',
                    'errors' => ['login'=> 'This login name is busy']
                ];
            }

            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['management'] = Status::$admin_panel;
            $data['email'] = isset($data['email']) ? $data['email'] : '';
            $data['position'] = isset($data['position']) ? $data['position'] : '';

            if (isset($data['role_id']) && $data['role_id'] != $item->id){
                $alert = new Notification();
                $alert->name = "Change role";
                $alert->desc = "The user role named ".$item->role->name." has been changed";
                $alert->type = Status::$change_role;
                $alert->model_id = $item->role->id;
                $alert->user_id = $item->id;
                $alert->clinic_id = auth()->user()->clinic_id;
                $alert->token =  Str::random(10);
                $alert->save();
            }


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
    public function profilUpdate(array $data, $id, $image = null)
    {
        try {

            $item = $this->model::find($id);

            $validator = $this->dataValidator($data, $this->profileUpdateFields());
            $imageValidator = $this->dataValidator($data, $this->imageFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }
            if (!$imageValidator['status']) {
                $this->uploadImagesOne($item, $image);
            }

            $data = $validator['data'];
            $isLogin = $this->model::where('login', $data['login'])->first();
            if ($isLogin && $isLogin->id != $id){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'This login name is busy',
                    'errors' => ['login'=> 'This login name is busy']
                ];
            }

            $data['role_id'] = $item->role_id;
            $data['clinic_id'] =$item->clinic_id;
            $data['management'] = Status::$admin_panel;
            $data['email'] = isset($data['email']) ? $data['email'] : '';
            $data['position'] = $item->position;
            $data['payable'] = $item->payable;
            $data['due'] = $item->due;

            foreach ($this->updateFields() as $field) {
                $field->fill($item, $data);
            }
            $item->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new AuthUserResource($item)
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
            if ($item->private != Status::$status_active){
                $item->delete($id);
            }

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

        $data = $this->model::where(function ($query) use ($search) {
            foreach ($this->columns as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
            ->where('private', Status::$status_inactive)
            ->where('clinic_id', auth()->user()->clinic_id)
            ->limit(10)
            ->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $this->resource::collection($data)
        ];
    }

}
