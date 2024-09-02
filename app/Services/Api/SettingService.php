<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\SettingsResources;
use App\Models\ClinicUser;
use App\Models\Medicine;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
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
        ];
    }
    public function updateCurrencyFields()
    {
        return [
            TextField::make('currency_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|numeric'),
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
            $item = $this->model::where('clinic_id', auth()->user()->clinic_id)->first();
            $data = $validator['data'];
            $data['phone'] = isset($data['phone']) ? $data['phone'] : '+(998)';
            $data['email'] = isset($data['email']) ? $data['email'] : 'example@email.com';
            $data['address'] = isset($data['address']) ? $data['address'] : '';
            $data['clinic_id'] = auth()->user()->clinic_id;
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
    public function updateCurrency(array $data)
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

            $validator = $this->dataValidator($data, $this->updateCurrencyFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $item = $this->model::where('clinic_id', auth()->user()->clinic_id)->first();
            $item->currency_id = $data['currency_id'];
            $item->save();

//            Medicine::withoutTrashed()->each(function ($medicine) use ($data) {
//                $medicine->update([
//                    'price' => $medicine->price * $data['amount'],
//                    'buy_price' => $medicine->buy_price * $data['amount'],
//                    'selling_price' => $medicine->selling_price * $data['amount'],
//                    'vat' => $medicine->vat * $data['amount'],
//                    'igta' => $medicine->igta * $data['amount'],
//                    'currency_id' => $data['currency_id'],
//                ]);
//            });

            Medicine::withoutTrashed()->each(function ($medicine) use ($data) {
                $medicine->update([
                    'price' => round($medicine->price * $data['amount'], 2),
                    'buy_price' => round($medicine->buy_price * $data['amount'], 2),
                    'selling_price' => round($medicine->selling_price * $data['amount'], 2),
                    'vat' => round($medicine->vat * $data['amount'], 2),
                    'igta' => round($medicine->igta * $data['amount'], 2),
                    'currency_id' => $data['currency_id'],
                ]);
            });


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
