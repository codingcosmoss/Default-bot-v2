<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\CurrencyResource;
use App\Models\ClinicUser;
use App\Models\Currency;


class CurrencyService extends AbstractPublicService
{
    protected $model = Currency::class;
    protected $resource = CurrencyResource::class;
    protected $columns = ['name', 'title', 'sign'];
    protected $menu = 'Currencies';


    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('string|required'),
            TextField::make('title')->setRules('string|required'),
            TextField::make('sign')->setRules('string|required'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('string|required'),
            TextField::make('title')->setRules('string|required'),
            TextField::make('sign')->setRules('string|required'),
        ];
    }

}
