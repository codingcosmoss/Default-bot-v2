<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\BatchResource;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\ExpiredResource;
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


class ExpiredMedicineService extends AbstractService
{
    protected $model = Batch::class;
    protected $resource = BatchResource::class;
    protected $columns = ['name'];
    protected $menu = 'ExpiredMedicines';
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
    public function getPaginate($count = 10)
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

            // Muddati o'tgan dorilar
            $models =  Batch::where('clinic_id', auth()->user()->clinic_id)
                ->where('amount', '>', 0)
                ->where('is_expiration', Status::$status_inactive)
                ->orderBy('expiry_date_finished', 'desc')
                ->paginate($count);


            $data = [
                'items' => ExpiredResource::collection($models),
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

}
