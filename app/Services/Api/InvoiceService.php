<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\InvoicesResource;
use App\Models\ClinicUser;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\SellingPayment;
use App\Models\SoldMedicine;
use App\Traits\Status;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class InvoiceService extends AbstractService
{
    protected $model = Invoice::class;
    protected $resource = InvoicesResource::class;
    protected $columns = ['date'];
    protected $menu = 'Selling';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('user_id')->setRules('nullable'),
            TextField::make('date')->setRules('nullable'),

            TextField::make('currency_id')->setRules('required|integer'),
            TextField::make('customer_id')->setRules('required|integer'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|integer'),
            TextField::make('amount_paid')->setRules('required|numeric'),
            TextField::make('must_paid')->setRules('required|numeric'),
            TextField::make('subtotal')->setRules('required|numeric'),
            TextField::make('igta')->setRules('required|numeric'),
            TextField::make('gst')->setRules('required|numeric'),
            TextField::make('medicines')->setRules('required|array')
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
        ];
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
            $data['user_id'] = auth()->user()->id;
            $data['date'] = date("Y-m-d");
            $medicines = $data['medicines'];
            $paymentType = $data['payment_type_id'];

            DB::beginTransaction();
            $isSaved = true;
            $object = new $this->model;
            $object->clinic_id = $data['clinic_id'];
            $object->user_id = $data['user_id'];
            $object->customer_id = $data['customer_id'];
            $object->amount = $data['amount']; // amount $data dan olinadi
            $object->currency_id = $data['currency_id']; // currency_id $data dan olinadi
            $object->amount_paid = $data['amount_paid']; // amount_paid $data dan olinadi
            $object->must_paid = $data['must_paid']; // must_paid $data dan olinadi
            $object->subtotal = $data['subtotal']; // subtotal $data dan olinadi
            $object->igta = $data['igta']; // igta $data dan olinadi
            $object->gst = $data['gst']; // gst $data dan olinadi
            $object->date = $data['date']; // date $data dan olinadi
            $object->save() != true ? $isSaved = false : '';

            // Sotilgan dorilar
            foreach ($medicines as $medicine){
                $parentMedicine = Medicine::find($medicine['id']);
                $soldMedicine = new SoldMedicine();
                $soldMedicine->clinic_id = auth()->user()->clinic_id;
                $soldMedicine->user_id = $object->user_id;
                $soldMedicine->invoice_id = $object->id;
                $soldMedicine->customer_id = $data['customer_id'];
                $soldMedicine->medicine_id = $medicine['id'];
                $soldMedicine->name = $medicine['name'];
                $soldMedicine->amount = $medicine['selling_amount'];
                $soldMedicine->price = $medicine['price'];
                $soldMedicine->subtotal = $medicine['selling_amount'] *  $medicine['price'];
                $soldMedicine->currency_id = $data['currency_id'];
                $soldMedicine->save() != true ? $isSaved = false : '';

                $parentMedicine->changeAmount(Status::$selling, $soldMedicine) == false ? $isSaved = false : '';

            }

            $sellingPayment = new SellingPayment();
            $sellingPayment->clinic_id = auth()->user()->clinic_id;
            $sellingPayment->user_id = $object->user_id;
            $sellingPayment->invoice_id = $object->id;
            $sellingPayment->customer_id = $data['customer_id'];
            $sellingPayment->amount = $object->amount_paid;
            $sellingPayment->payment_type_id = $paymentType;
            $sellingPayment->currency_id = $data['currency_id'];
            $sellingPayment->save() != true ? $isSaved = false : '';

            if ($isSaved){
                DB::commit();
                return [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Success',
                    'data' => new $this->resource($object)
                ];
            }else{
                DB::rollBack();
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Server error',
                    'data' => null
                ];
            }



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
