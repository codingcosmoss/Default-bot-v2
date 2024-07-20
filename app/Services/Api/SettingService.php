<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\SettingsResources;
use App\Models\ClinicUser;
use App\Models\Setting;
use Mockery\Exception;


class SettingService extends AbstractService
{
    protected $model = Setting::class;
    protected $resource = SettingsResources::class;
    protected $columns = ['name'];
    protected $menu = 'Settings';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('nullable|string'),
            TextField::make('email')->setRules('nullable|string'),
            TextField::make('address')->setRules('nullable|string'),
            TextField::make('currency_id')->setRules('nullable|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
            TextField::make('phone')->setRules('nullable|string'),
            TextField::make('email')->setRules('nullable|string'),
            TextField::make('address')->setRules('nullable|string'),
            TextField::make('clinic_id')->setRules('nullable|integer'),
            TextField::make('currency_id')->setRules('nullable|string'),
        ];
    }
    public function show($id)
    {
        try {
            $data = $this->model::where('clinic_id', $id)->first();
            if (!$data){
                $data = new $this->model();
                $data->clinic_id = auth()->user()->clinic_id;
                $data->name = 'Clinic name';
                $data->save();
            }

            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
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
            $item = $this->model::where('clinic_id', auth()->user()->clinic_id)->first();
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
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '+(998)';
            $data['email'] = isset($data['email']) ? $data['email'] : 'example@email.com';
            $data['address'] = isset($data['address']) ? $data['address'] : '';
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['currency_id'] = isset($data['currency_id']) ? $data['currency_id'] : 1;
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
