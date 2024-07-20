<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\SettingsResources;
use App\Models\ClinicUser;
use App\Models\Customer;
use App\Models\Setting;
use Mockery\Exception;


class CustomerService extends AbstractService
{
    protected $model = Customer::class;
    protected $resource = CustomerResource::class;
    protected $columns = ['name', 'email', 'phone'];
    protected $menu = 'Customers';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('nullable|string'),
            TextField::make('email')->setRules('nullable|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('address')->setRules('nullable|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('nullable|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('email')->setRules('nullable|string'),
            TextField::make('address')->setRules('nullable|string'),
        ];
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
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '+(998)';
            $data['email'] = isset($data['email']) ? $data['email'] : 'example@email.com';
            $data['address'] = isset($data['address']) ? $data['address'] : '';
            $object = new $this->model;
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
    public function update(array $data, $id,  $image = null)
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
            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '+(998)';
            $data['email'] = isset($data['email']) ? $data['email'] : 'example@email.com';
            $data['address'] = isset($data['address']) ? $data['address'] : '';
            foreach ($this->updateFields() as $field) {
                $field->fill($item, $data);
            }
            $item->save();
            if (!$imageValidator['status']) {
                $this->uploadImagesOne($item, $image);
            }

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
