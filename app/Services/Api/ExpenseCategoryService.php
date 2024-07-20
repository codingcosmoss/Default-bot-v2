<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ExpenseCategoryResource;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Models\ExpenseCategory;


class ExpenseCategoryService extends AbstractService
{
    protected $model = ExpenseCategory::class;
    protected $resource = ExpenseCategoryResource::class;
    protected $columns = ['name', 'description'];
    protected $menu = 'ExpenseCategories';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


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

    public function getCategoryExpensesSearch($id,  $search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }
        $data = Expense::where(function ($query) use ($search) {
            foreach (['title', 'amount', 'date'] as $column) {
                $query->orWhere($column, 'like', '%' . $search . '%');
            }
        })
            ->where('clinic_id', auth()->user()->clinic_id )
            ->where('expense_category_id', $id )
            ->limit(10)
            ->get();

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => ExpenseResource::collection($data)
        ];

    }


}
