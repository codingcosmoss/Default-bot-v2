<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Models\ClinicUser;


class SellingService extends AbstractService
{
    protected $model = ClinicUser::class;
    protected $resource = ClinicUserResource::class;
    protected $columns = ['name'];
    protected $menu = '';
    protected $isClinic = false; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
        ];
    }

}
