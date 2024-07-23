<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\MedicineCategoryResource;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\SizeTypeResource;
use App\Http\Resources\WarehouseCategoryResource;
use App\Http\Resources\WarehouseResource;
use App\Models\ClinicUser;
use App\Models\MedicineCategory;
use App\Models\PaymentType;
use App\Models\SizeType;
use App\Models\Warehouse;
use App\Models\WarehouseCategory;


class PaymentTypeService extends AbstractService
{
    protected $model = PaymentType::class;
    protected $resource = PaymentTypeResource::class;
    protected $columns = ['name'];
    protected $menu = 'PaymentTypes';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }

}
