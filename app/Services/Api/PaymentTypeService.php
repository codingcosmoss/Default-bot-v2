<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\MedicineCategoryResource;
use App\Http\Resources\PaymentsResource;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\SizeTypeResource;
use App\Http\Resources\SupplierPaymentsResource;
use App\Http\Resources\WarehouseCategoryResource;
use App\Http\Resources\WarehouseResource;
use App\Models\ClinicUser;
use App\Models\DocumentPayment;
use App\Models\MedicineCategory;
use App\Models\PaymentType;
use App\Models\SellingPayment;
use App\Models\SizeType;
use App\Models\Warehouse;
use App\Models\WarehouseCategory;
use App\Traits\Status;
use Mockery\Exception;


class PaymentTypeService extends AbstractService
{
    protected $model = PaymentType::class;
    protected $resource = PaymentTypeResource::class;
    protected $columns = ['name'];
    protected $menu = 'PaymentTypes';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('name')->setRules('required|string'),
            TextField::make('status')->setRules('required|integer'),
        ];
    }

    public function getCustomerPaginate($count = 10)
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

            $models = SellingPayment::where('clinic_id', auth()->user()->clinic_id)
                ->orderBy('id', 'asc')
                ->paginate($count);

            $data = [
                'items' => PaymentsResource::collection($models),
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
    public function getSupplierPaginate($count = 10)
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

            $models = DocumentPayment::where('clinic_id', auth()->user()->clinic_id)
                ->orderBy('id', 'asc')
                ->paginate($count);

            $data = [
                'items' => SupplierPaymentsResource::collection($models),
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
    public function searchCustomers($search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        $data = SellingPayment::join('customers', 'selling_payments.customer_id', '=', 'customers.id')
            ->where('selling_payments.clinic_id', auth()->user()->clinic_id)
            ->where(function ($query) use ($search) {
                foreach ( ['amount', 'created_at'] as $column) {
                    $query->orWhere("selling_payments.$column", 'like', '%' . $search . '%');
                }
                $query->orWhere('customers.name', 'like', '%' . $search . '%');
            })
            ->select('selling_payments.*') // Faqat SellingPayment ustunlarini tanlash
            ->limit(10)
            ->get();


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => PaymentsResource::collection($data)
        ];
    }
    public function searchSuppliers($search = '')
    {
        if (!$this->hasPermission('index')){
            return [
                'status' => false,
                'code' => 403,
                'message' => 'Root access is not allowed ',
                'data' => null
            ];
        }

        $data = DocumentPayment::join('suppliers', 'document_payments.supplier_id', '=', 'suppliers.id')
            ->where('document_payments.clinic_id', auth()->user()->clinic_id)
            ->where(function ($query) use ($search) {
                foreach ( ['amount', 'created_at'] as $column) {
                    $query->orWhere("document_payments.$column", 'like', '%' . $search . '%');
                }
                $query->orWhere('suppliers.name', 'like', '%' . $search . '%');
            })
            ->select('document_payments.*') // Faqat SellingPayment ustunlarini tanlash
            ->limit(10)
            ->get();


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => SupplierPaymentsResource::collection($data)
        ];
    }

    public function activeIndex()
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

            $data = $this->model::where('clinic_id', auth()->user()->clinic_id)
                ->where('status', Status::$status_active)
                ->orWhere('status', Status::$default)
                ->get();

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
