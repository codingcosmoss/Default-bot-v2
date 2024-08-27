<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\MedicineActivesResource;
use App\Http\Resources\MedicineResource;
use App\Models\Batch;
use App\Models\ClinicUser;
use App\Models\Medicine;
use App\Models\Setting;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class MedicineService extends AbstractService
{
    protected $model = Medicine::class;
    protected $resource = MedicineResource::class;
    protected $columns = ['name', 'generic_name', 'desc'];
    protected $menu = 'Medicines';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi

    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('currency_id')->setRules('nullable'),
            TextField::make('medicine_category_id')->setRules('required|integer'),
            TextField::make('box_size_id')->setRules('required|integer'),
            TextField::make('drug_company_id')->setRules('required|integer'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('generic_name')->setRules('required|string'),
            TextField::make('buy_price')->setRules('required|numeric'),
            TextField::make('selling_price')->setRules('required|numeric'),
            TextField::make('percentage')->setRules('required|numeric'),
            TextField::make('size_type_id')->setRules('required|numeric'),
            TextField::make('price')->setRules('required|numeric'),

            TextField::make('qr_code')->setRules('nullable|string'),
            TextField::make('hns_code')->setRules('nullable|string'),
            TextField::make('qr_code')->setRules('nullable|string'),
            TextField::make('desc')->setRules('nullable|string'),
            TextField::make('strength')->setRules('nullable|numeric'),
            TextField::make('desc')->setRules('nullable|string'),
            TextField::make('shelf')->setRules('nullable|string'),
            TextField::make('vat')->setRules('nullable|numeric'),
            TextField::make('igta')->setRules('nullable|numeric'),
            TextField::make('status')->setRules('nullable|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('currency_id')->setRules('nullable'),
            TextField::make('medicine_category_id')->setRules('required|integer'),
            TextField::make('box_size_id')->setRules('required|integer'),
            TextField::make('drug_company_id')->setRules('required|integer'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('generic_name')->setRules('required|string'),
            TextField::make('buy_price')->setRules('required|numeric'),
            TextField::make('selling_price')->setRules('required|numeric'),
            TextField::make('percentage')->setRules('required|numeric'),
            TextField::make('size_type_id')->setRules('required|numeric'),
            TextField::make('price')->setRules('required|numeric'),

            TextField::make('qr_code')->setRules('nullable|string'),
            TextField::make('hns_code')->setRules('nullable|string'),
            TextField::make('qr_code')->setRules('nullable|string'),
            TextField::make('desc')->setRules('nullable|string'),
            TextField::make('strength')->setRules('nullable|numeric'),
            TextField::make('desc')->setRules('nullable|string'),
            TextField::make('shelf')->setRules('nullable|string'),
            TextField::make('vat')->setRules('nullable|numeric'),
            TextField::make('igta')->setRules('nullable|numeric'),
            TextField::make('status')->setRules('nullable|integer'),
        ];
    }
    public function getMedicinesCollection(array $data)
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        $data = $this->model::whereIn('id', $data['medicines'])->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => MedicineActivesResource::collection($data)
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

            $setting =  Setting::where('clinic_id', auth()->user()->clinic_id)->first();
            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['currency_id'] = $setting->currency_id;
            $data['qr_code'] = $data['qr_code'] ?? '';
            $data['hns_code'] = $data['hns_code'] ?? '';
            $data['desc'] = $data['desc'] ?? '';
            $data['strength'] = $data['strength'] ?? null;
            $data['shelf'] = $data['shelf'] ?? '';
            $data['vat'] = $data['vat'] ?? 0;
            $data['parent_id'] = 0;
            $data['igta'] = $data['igta'] ?? 0;
            $data['status'] = $data['status'] ?? Status::$status_active;

            $object = new $this->model;
            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save();
            $object->parent_id = $object->id;
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
            $setting =  Setting::where('clinic_id', auth()->user()->clinic_id)->first();
            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['currency_id'] = $setting->currency_id;
            $data['qr_code'] = $data['qr_code'] ?? '';
            $data['hns_code'] = $data['hns_code'] ?? '';
            $data['desc'] = $data['desc'] ?? '';
            $data['strength'] = $data['strength'] ?? null;
            $data['shelf'] = $data['shelf'] ?? '';
            $data['vat'] = $data['vat'] ?? 0;
            $data['igta'] = $data['igta'] ?? 0;
            $data['status'] = $data['status'] ?? Status::$status_active;

            $data['price'] = $data['buy_price'] + $data['selling_price'];

            if (!$imageValidator['status']) {
                $this->uploadImagesOne($item, $image);
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
    public function activeSearch($search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        if ($search != 'all'){
            $data = $this->model::where(function ($query) use ($search) {
                foreach ($this->columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
                ->where('clinic_id', auth()->user()->clinic_id)
                ->where('status', Status::$status_active)
                ->limit(10)
                ->get();
        }else{
            $data = $this->model::where('clinic_id', auth()->user()->clinic_id)
                ->where('status', Status::$status_active)
                ->limit(10)
                ->get();
        }


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => MedicineActivesResource::collection($data)
        ];
    }
    public function quantityVerification()
    {
        try {
            DB::beginTransaction();
            $isSaved = true;
            $batches = Batch::where('is_expiration', Status::$status_active)
                ->where('amount','>', 0)
                ->where('expiry_date_finished', '<=', Carbon::now())
                ->get();

            foreach ($batches as $batch){
                $batchModel = Batch::find($batch->id);
                $batchModel->is_expiration = Status::$status_inactive;
                $batchModel->save() != true ? $isSaved = false : '';

                $medicine = Medicine::find($batch->medicine_id);
                $medicine->changeAmount(Status::$returned, $batchModel) != true ? $isSaved = false : '';

            }

            if ($isSaved){
                DB::commit();
                return [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Success',
                    'data' => null
                ];
            }else{
                DB::rollBack();
                return [
                    'status' => false,
                    'code' => 200,
                    'message' => 'Server error',
                    'data' => null
                ];
            }


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
