<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\UserResources;
use App\Models\ClinicUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;


class UserService extends AbstractService
{
    protected $model = User::class;
    protected $resource = UserResources::class;
    protected $columns = ['name'];

    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('login')->setRules('required|string|min:5'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('role_id')->setRules('required|integer'),
            TextField::make('clinic_id')->setRules('required|integer'),
            TextField::make('management')->setRules('required|integer'),
            TextField::make('email')->setRules('nullable'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('login')->setRules('required|string|min:5'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('email')->setRules('nullable'),
        ];
    }

    public function updatePasswordFields()
    {
        return [
            TextField::make('password')->setRules('required|min:5'),
        ];
    }

    public function changePassword($data)
    {
        try {
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
            $user = $this->model::find(auth()->user()->id);
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

    public function store(array $data)
    {
        try {

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
    public function update(array $data, $id, $image = null)
    {
        try {
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
