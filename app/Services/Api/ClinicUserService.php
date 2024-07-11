<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Models\ClinicUser;
use Mockery\Exception;


class ClinicUserService extends AbstractService
{
    protected $model = ClinicUser::class;
    protected $resource = ClinicUserResource::class;
    protected $columns = ['name'];

    public function storeFields()
    {
        return [
            TextField::make('login')->setRules('required|string'),
            TextField::make('password')->setRules('required'),
            TextField::make('name')->setRules('required|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('login')->setRules('required|string'),
            TextField::make('password')->setRules('required'),
            TextField::make('name')->setRules('required|string'),
        ];
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
            if($isLogin){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => ['login' => "This login name is busy"]
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

    public function update(array $data, $id)
    {
        try {
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
            $fileds = $this->updateFields();

            $isLogin = $this->model::where('login', $data['login'])->first();
            if ($data['login'] == $item->login){
                unset($data['login']);
                $fileds = array_slice($fileds, 1);
            }else if($isLogin){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => ['login' => "This login name is busy"]
                ];
            }
            foreach ($fileds as $field) {
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
