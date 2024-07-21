<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\DrugCompanyResource;
use App\Http\Resources\SizeTypeResource;
use App\Models\ClinicUser;
use App\Models\DrugCompany;
use App\Models\SizeType;


class DrugCompanyService extends AbstractService
{
    protected $model = DrugCompany::class;
    protected $resource = DrugCompanyResource::class;
    protected $columns = ['name'];
    protected $menu = 'DrugCompanies';
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
