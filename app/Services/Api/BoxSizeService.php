<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\BoxSizeResource;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\SizeTypeResource;
use App\Models\BoxSize;
use App\Models\ClinicUser;
use App\Models\SizeType;


class BoxSizeService extends AbstractService
{
    protected $model = BoxSize::class;
    protected $resource = BoxSizeResource::class;
    protected $columns = ['size'];
    protected $menu = 'BoxSizes';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('sign')->setRules('required'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('size')->setRules('required|numeric'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('sign')->setRules('required'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('size')->setRules('required|string'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }

}
