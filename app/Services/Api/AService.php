<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Models\ClinicUser;


class AService extends AbstractService
{
    protected $model = ClinicUser::class;
    protected $resource = ClinicUserResource::class;
    protected $columns = ['name'];

    public function storeFields()
    {
        return [
            TextField::make('column')->setRules('required|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('column')->setRules('required|string'),
        ];
    }

}
