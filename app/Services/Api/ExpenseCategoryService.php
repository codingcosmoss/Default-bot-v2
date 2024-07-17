<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;


class ExpenseCategoryService extends AbstractService
{
    protected $model = ExpenseCategory::class;
    protected $resource = ExpenseCategoryResource::class;
    protected $columns = ['name', 'description'];
    protected $menu = 'ExpenseCategories';


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('description')->setRules('required|string'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('description')->setRules('required|string'),
        ];
    }

}
