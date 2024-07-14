<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
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
        ];
    }

    public function updatePasswordFields()
    {
        return [
            TextField::make('password')->setRules('required|min:5'),
        ];
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

            $alert = new Notification();
            $alert->name = "Change role";
            $alert->desc = "The user role named ".$item->role->name." has been changed";
            $alert->type = Status::$change_role;
            $alert->model_id = $item->role->id;
            $alert->user_id = $item->id;
            $alert->clinic_id = auth()->user()->clinic_id;
            $alert->token =  Str::random(10);
            $alert->save();

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

}
