<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\MedicineResource;
use App\Http\Resources\SalePurchaseResource;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\ImportedMedicine;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class ReportService extends AbstractService
{
    protected $model = null;
    protected $resource = null;
    protected $columns = [''];
    protected $menu = 'Reports';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


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
    public function getSallings($count = 10)
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
            $models = DB::table('invoices')
                ->select( 'date', 'currency_id', DB::raw('SUM(subtotal) as total_subtotal'), DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(must_paid) as must_paid'))
                ->groupBy('date', 'currency_id')
                ->paginate($count);

            foreach ($models as $key => $value) {
                $models[$key]->currency = Currency::find($value->currency_id);
            }

            $data = [
                'items' => $models,
                'pagination' => [
                    'total' => $models->total(),
                    'per_page' => $models->perPage(),
                    'current_page' => $models->currentPage(),
                    'last_page' => $models->lastPage(),
                    'from' => $models->firstItem(),
                    'to' => $models->lastItem(),
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
    public function getPurchases($count = 10)
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
            $models = DB::table('documents')
                ->select(
                    'date',
                    'currency_id',
                    DB::raw('SUM(subtotal) as total_subtotal'),
                    DB::raw('SUM(subtotal - amount_paid) as must_paid')
                )
                ->groupBy('date', 'currency_id')
                ->paginate($count);

            foreach ($models as $key => $value) {
                $models[$key]->currency = Currency::find($value->currency_id);
            }

            $data = [
                'items' => $models,
                'pagination' => [
                    'total' => $models->total(),
                    'per_page' => $models->perPage(),
                    'current_page' => $models->currentPage(),
                    'last_page' => $models->lastPage(),
                    'from' => $models->firstItem(),
                    'to' => $models->lastItem(),
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
    public function getBestSellers($count = 10)
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

            $models = DB::table('sold_medicines')
                ->select(
                    'medicine_id',
                    'currency_id',
                    DB::raw('SUM(result_sum) as total_subtotal'),
                    DB::raw('SUM(amount) as total_amount')
                )
                ->groupBy('medicine_id', 'currency_id')
                ->orderBy('total_amount', 'desc') // amount bo'yicha o'sish tartibida tartiblash
                ->paginate($count);


            foreach ($models as $key => $value) {
                $models[$key]->medicine = new MedicineResource(Medicine::withoutTrashed()->find($value->medicine_id));
            }

            $data = [
                'items' => $models,
                'pagination' => [
                    'total' => $models->total(),
                    'per_page' => $models->perPage(),
                    'current_page' => $models->currentPage(),
                    'last_page' => $models->lastPage(),
                    'from' => $models->firstItem(),
                    'to' => $models->lastItem(),
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

    public function dashboardCart1()
    {
        try {

            $medicinesCount =  Medicine::where('clinic_id', auth()->user()->clinic_id)
                ->count();

            $expiredMedicinesCount =  ImportedMedicine::where('clinic_id', auth()->user()->clinic_id)
                ->count();

            $expiredMedicinesCount =  ImportedMedicine::where('clinic_id', auth()->user()->clinic_id)
                ->count();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => null
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
