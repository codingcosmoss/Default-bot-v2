<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\BatchResource;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\ImportedMedicineResource;
use App\Http\Resources\MedicineResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\SalePurchaseResource;
use App\Models\Batch;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\Document;
use App\Models\ExpenseCategory;
use App\Models\ImportedMedicine;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\SoldMedicine;
use App\Traits\Status;
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
                ->where('clinic_id', auth()->user()->clinic_id)
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

            // Muddati o'tgan dorilar
            $expiredMedicines =  Batch::where('clinic_id', auth()->user()->clinic_id)
                ->where('amount', '>', 0)
                ->where('is_expiration', Status::$status_inactive)
                ->get();

            // Olib kelingan dorilar
            $importedMedicines =  ImportedMedicine::where('clinic_id', auth()->user()->clinic_id)
                ->get();

            $realMedicines = DB::table('medicines')
                ->leftJoin('remaining_drugs', function ($join) {
                    $join->on('medicines.id', '=', 'remaining_drugs.medicine_id')
                        ->whereRaw('remaining_drugs.id = (
                 SELECT MAX(id)
                 FROM remaining_drugs AS rd
                 WHERE rd.medicine_id = medicines.id
             )');
                })
                ->select('medicines.*', 'remaining_drugs.*') // Agar kerak bo'lsa, tanlashni sozlashingiz mumkin
                ->get();

            // Eng kop sotilgan dorilar
            $bestSellers = DB::table('sold_medicines')
                ->select(
                    'medicine_id',
                    'currency_id',
                    DB::raw('SUM(result_sum) as total_subtotal'),
                    DB::raw('SUM(amount) as total_amount')
                )
                ->where('clinic_id', auth()->user()->clinic_id)
                ->groupBy('medicine_id', 'currency_id')
                ->orderBy('total_amount', 'desc') // amount bo'yicha o'sish tartibida tartiblash
                ->limit(20);


            $data = [
                'medicines_count' => $medicinesCount, // barcha dorilar soni
                'expiredMedicines' => BatchResource::collection($expiredMedicines),
                'importedMedicines' => ImportedMedicineResource::collection($importedMedicines),
                'realMedicinesCount' => $realMedicines,
                'bestSellers' => $bestSellers
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
    public function dashboardCart2()
    {
        try {

            // mijozlarga sotilgan dorilar
            $medicinesSoldCustomers = DB::table('invoices')
                ->select(
                    'invoices.currency_id',
                    DB::raw('SUM(invoices.subtotal) as total_cost'),
                    DB::raw('SUM(invoices.amount) as total_amount'),
                    'currencies.sign as sign' // Valyuta nomini olish
                )
                ->join('currencies', 'invoices.currency_id', '=', 'currencies.id') // invoices va currencies jadvalini bog'lash
                ->where('invoices.clinic_id', auth()->user()->clinic_id)
                ->groupBy('invoices.currency_id', 'currencies.sign') // currency_id va sign bo'yicha guruhlash
                ->get();

// omborga sotib olingan dorilar
            $importedMedicines = DB::table('imported_medicines')
                ->select(
                    'imported_medicines.currency_id',
                    DB::raw('SUM(imported_medicines.total_cost) as total_cost'),
                    DB::raw('SUM(imported_medicines.amount) as amount'),
                    'currencies.sign as sign' // Valyuta nomini olish
                )
                ->join('currencies', 'imported_medicines.currency_id', '=', 'currencies.id') // imported_medicines va currencies jadvalini bog'lash
                ->where('imported_medicines.clinic_id', auth()->user()->clinic_id)
                ->groupBy('imported_medicines.currency_id', 'currencies.sign') // currency_id va sign bo'yicha guruhlash
                ->get();

// Jami xarajatlar
            $expenses = DB::table('expenses')
                ->select(
                    'expenses.currency_id',
                    DB::raw('SUM(expenses.amount) as total_cost'),
                    'currencies.sign as sign' // Valyuta nomini olish
                )
                ->join('currencies', 'expenses.currency_id', '=', 'currencies.id') // expenses va currencies jadvalini bog'lash
                ->where('expenses.clinic_id', auth()->user()->clinic_id)
                ->groupBy('expenses.currency_id', 'currencies.sign') // currency_id va sign bo'yicha guruhlash
                ->get();

            $selling = DB::table('invoices')
                ->select(
                    'date',
                    DB::raw('SUM(subtotal) as subtotal'),
                )
                ->where('clinic_id', auth()->user()->clinic_id)
                ->groupBy('date') // currency_id va sign bo'yicha guruhlash
                ->orderBy('date', 'desc')
                ->get();

            $purchases = DB::table('documents')
                ->select(
                    'date',
                    DB::raw('SUM(subtotal) as subtotal'),
                )
                ->where('clinic_id', auth()->user()->clinic_id)
                ->groupBy('date') // currency_id va sign bo'yicha guruhlash
                ->orderBy('date', 'desc')
                ->get();


            $data = [
                'medicinesSoldCustomers' =>$medicinesSoldCustomers, // barcha dorilar soni
                'importedSubtotalMedicines' =>  $importedMedicines, // barcha dorilar soni
                'expenses' =>  $expenses, // barcha dorilar soni
                'sellings' =>  $selling,
                'purchases' =>  $purchases,
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



}
