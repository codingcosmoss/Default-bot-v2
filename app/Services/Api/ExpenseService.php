<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\ExpenceTotalResource;
use App\Http\Resources\ExpenseResource;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class ExpenseService extends AbstractService
{
    protected $model = Expense::class;
    protected $resource = ExpenseResource::class;
    protected $columns = ['title', 'amount', 'date'];
    protected $menu = 'Expenses';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('title')->setRules('required|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('currency_id')->setRules('nullable'),
            TextField::make('amount')->setRules('required|integer'),
            TextField::make('date')->setRules('required|date'),
            TextField::make('expense_category_id')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('title')->setRules('required|string'),
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('currency_id')->setRules('nullable'),
            TextField::make('amount')->setRules('required|numeric'),
            TextField::make('date')->setRules('required|string'),
            TextField::make('expense_category_id')->setRules('required|integer'),
        ];
    }

    public function currencies($id)
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $datas = $this->model::where('clinic_id', auth()->user()->clinic_id )
                ->where('currency_id', $id)
                ->orderBy('date', 'desc')
                ->paginate(100);

            $data = [
                'items' => $this->resource::collection($datas),
                'pagination' => [
                    'total' => $datas->total(),
                    'per_page' => $datas->perPage(),
                    'current_page' => $datas->currentPage(),
                    'last_page' => $datas->lastPage(),
                    'from' => $datas->firstItem(),
                    'to' => $datas->lastItem(),
                ],
            ];

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function total()
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $expensesGroupedByCurrency = Expense::where('clinic_id', auth()->user()->clinic_id )
                ->select('currency_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('currency_id')
                ->get();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => ExpenceTotalResource::collection($expensesGroupedByCurrency)
            ];
        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function getCategoryExpenses($id)
    {
        try {
            if (!$this->hasPermission('index')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }

            $expenses = Expense::where('clinic_id', auth()->user()->clinic_id )
                ->where('expense_category_id', $id)
                ->paginate(100);

            $data = [
                'items' => $this->resource::collection($expenses),
                'pagination' => [
                    'total' => $expenses->total(),
                    'per_page' => $expenses->perPage(),
                    'current_page' => $expenses->currentPage(),
                    'last_page' => $expenses->lastPage(),
                    'from' => $expenses->firstItem(),
                    'to' => $expenses->lastItem(),
                ],
            ];

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    public function store(array $data)
    {
        try {
            if (!$this->hasPermission('create')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            $validator = $this->dataValidator($data, $this->storeFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }

            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $setting = Setting::where('clinic_id', auth()->user()->clinic_id)->first();
            if (!isset( $data['currency_id'])){
                $data['currency_id'] = isset($setting) ? $setting->currency_id : 1;
            }
            $object = new $this->model;
            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($object)
            ];


        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }

    }
    public function update(array $data, $id)
    {
        try {
            if (!$this->hasPermission('update')){
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Root access is not allowed ',
                    'data' => null
                ];
            }
            $item = $this->model::find($id);
            $validator = $this->dataValidator($data, $this->updateFields());
            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }
            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $setting = Setting::where('clinic_id', auth()->user()->clinic_id)->first();
            if (!isset( $data['currency_id'])){
                $data['currency_id'] = isset($setting) ? $setting->currency_id : 1;
            }
            foreach ($this->updateFields() as $field) {
                $field->fill($item, $data);
            }
            $item->save();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new $this->resource($item)
            ];

        }catch (Exception $e){
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

}
