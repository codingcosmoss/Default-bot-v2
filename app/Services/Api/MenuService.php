<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\MenuResource;
use App\Models\ClinicUser;
use App\Models\Menu;


class MenuService extends AbstractService
{
    protected $model = Menu::class;
    protected $resource = MenuResource::class;
    protected $columns = ['name'];
    protected $menuId = 2;

    public function storeFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('name')->setRules('required|string'),
        ];
    }

}
