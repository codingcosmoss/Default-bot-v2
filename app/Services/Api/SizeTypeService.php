<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\SizeTypeResource;
use App\Models\ClinicUser;
use App\Models\SizeType;


class SizeTypeService extends AbstractService
{
    protected $model = SizeType::class;
    protected $resource = SizeTypeResource::class;
    protected $columns = ['name'];
    protected $menu = 'DrugSizeTypes';
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
