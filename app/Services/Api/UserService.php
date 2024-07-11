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
                    'errors' => $validator['validator']->errors()
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

}
