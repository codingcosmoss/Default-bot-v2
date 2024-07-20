<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\SupplierResource;
use App\Models\ClinicUser;
use App\Models\Supplier;
use Mockery\Exception;


class SupplierService extends AbstractService
{
    protected $model = Supplier::class;
    protected $resource = SupplierResource::class;
    protected $columns = ['name', 'address', 'phone'];
    protected $menu = 'Suppliers';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('address')->setRules('nullable'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('required|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('address')->setRules('nullable'),
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
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '';
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
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '';
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
