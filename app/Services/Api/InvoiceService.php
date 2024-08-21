<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\InvoiceShowResource;
use App\Http\Resources\InvoicesResource;
use App\Models\ClinicUser;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\ReturnedMedicine;
use App\Models\SellingPayment;
use App\Models\SellingReturnedMedicine;
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
    public function returnMedicineFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('sold_medicine_id')->setRules('required|integer'),
            TextField::make('invoice_id')->setRules('required|integer'),
            TextField::make('customer_id')->setRules('required|integer'),
            TextField::make('return_amount')->setRules('required|integer'),
            TextField::make('return_price')->setRules('required|numeric'),
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

            $models = $this->model::where('clinic_id', auth()->user()->clinic_id)
                ->orderBy('created_at', 'desc')
                ->paginate($count);


            $data = [
                'items' => $this->resource::collection($models),
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
    public function returns($count = 10)
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

            $models = SellingReturnedMedicine::where('clinic_id', auth()->user()->clinic_id)
                ->orderBy('created_at', 'desc')
                ->paginate($count);


            $data = [
                'items' => $this->resource::collection($models),
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
            $object->date = $data['date']; // date $data dan olinadi
            $object->gst = 0; // gst $data dan olinadi
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
                $soldMedicine->igta = $medicine['igta'];
                $soldMedicine->subtotal = $medicine['selling_amount'] *  $medicine['price'];
                $soldMedicine->gst = ($soldMedicine->price * $data['gst'])/100;
                $soldMedicine->currency_id = $data['currency_id'];
                $soldMedicine->one_sum = $soldMedicine->igta + $soldMedicine->gst + $soldMedicine->price;
                $soldMedicine->result_sum = $soldMedicine->one_sum *  $soldMedicine->amount;
                $soldMedicine->save() != true ? $isSaved = false : '';
                $parentMedicine->changeAmount(Status::$selling, $soldMedicine) == false ? $isSaved = false : '';

            }
            $sum = $data['subtotal'] - $object->igta;
            $gst = 100+$data['gst'];
            $object->gst = ($sum * $data['gst'])/$gst; // gst $data dan olinadi
            $object->gst_percentage = $data['gst']; // gst $data dan olinadi
            $object->save() != true ? $isSaved = false : '';

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

    public function searchDate($data)
    {
        $startDate = isset($data['start']) ? $data['start'] : null ; // Boshlanish sanasi, null bo'lishi mumkin
        $endDate = isset($data['end']) ? $data['end'] : null ; // Tugash sanasi, null bo'lishi mumkin

        $query = $this->model::query();
        $query->where('clinic_id', auth()->user()->clinic_id);
        if ($startDate && $endDate) {
            // Ikkala sana mavjud bo'lsa
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            // Faqat startDate mavjud bo'lsa
            $query->where('date', '>=', $startDate);
        } elseif ($endDate) {
            // Faqat endDate mavjud bo'lsa
            $query->where('date', '<=', $endDate);
        }

        $models = $query->paginate(100);

        $data = [
            'items' => $this->resource::collection($models),
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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];

    }
    public function returnSearchDate($data)
    {
        $startDate = isset($data['start']) ? $data['start'] : null ; // Boshlanish sanasi, null bo'lishi mumkin
        $endDate = isset($data['end']) ? $data['end'] : null ; // Tugash sanasi, null bo'lishi mumkin

        $query = SellingReturnedMedicine::query();
        $query->where('clinic_id', auth()->user()->clinic_id);
        if ($startDate && $endDate) {
            // Ikkala sana mavjud bo'lsa
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            // Faqat startDate mavjud bo'lsa
            $query->where('created_at', '>=', $startDate);
        } elseif ($endDate) {
            // Faqat endDate mavjud bo'lsa
            $query->where('created_at', '<=', $endDate);
        }

        $models = $query->paginate(100);

        $data = [
            'items' => $this->resource::collection($models),
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
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];

    }
    public function show($id)
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
                ->where('id', $id)
                ->first();
            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' => new InvoiceShowResource($data)
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

    public function returnMedicine(array $data)
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
            $validator = $this->dataValidator($data, $this->returnMedicineFields());

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
            DB::beginTransaction();
            $isSaved = true;

            $invoice = Invoice::find($data['invoice_id']);
            $sum = 0;
           if ($data['return_amount'] > 0){
               // Qaytarilgan dori
               $soldMedicine = SoldMedicine::find($data['sold_medicine_id']);
               $soldMedicine->amount -= $data['return_amount'];
               $soldMedicine->subtotal -= $data['return_amount'] *  $soldMedicine->price;
               $soldMedicine->result_sum -= $data['return_amount'] *  $soldMedicine->one_sum;
               $soldMedicine->save() != true ? $isSaved = false : '';

               $parentMedicine = Medicine::find($soldMedicine->medicine_id);
               $returnMedicine = new SellingReturnedMedicine();
               $returnMedicine->clinic_id = auth()->user()->clinic_id;
               $returnMedicine->user_id = auth()->user()->id;
               $returnMedicine->invoice_id = $data['invoice_id'];
               $returnMedicine->customer_id = $data['customer_id'];
               $returnMedicine->name = $soldMedicine->name;
               $returnMedicine->igta = $soldMedicine->igta;
               $returnMedicine->amount = $data['return_amount'];
               $returnMedicine->price = $soldMedicine->price;
               $returnMedicine->subtotal = $data['return_amount'] *  $soldMedicine->price;
               $returnMedicine->gst = $soldMedicine->gst;
               $returnMedicine->currency_id = $soldMedicine->currency_id;
               $returnMedicine->save() != true ? $isSaved = false : '';

               $parentMedicine->changeAmount(Status::$invoiceReturned, $returnMedicine) == false ? $isSaved = false : '';

               $sum = $data['return_amount'] * $soldMedicine->one_sum;
           }

            if ($data['return_amount'] > 0){
                $invoice->amount -= $data['return_amount'];
                $invoice->igta -= $soldMedicine->igta * $data['return_amount'];
                $invoice->gst -= $soldMedicine->gst * $data['return_amount'];
            }

            if ($invoice->amount_paid < $data['return_price']){
                $invoice->amount_paid = 0;
            }else{
                $invoice->amount_paid -= $data['return_price'];
            }

            $amountPaid =  $invoice->amount_paid;

            if ($data['return_amount'] > 0){
                if ($invoice->subtotal < $sum){
                    $invoice->subtotal = 0;
                }else{
                    $invoice->subtotal -= $sum;
                }
                $subtotal =  $invoice->subtotal;
                if ($subtotal - $amountPaid < 0){
                    $invoice->must_paid = 0;
                }else{
                    $invoice->must_paid = $subtotal - $amountPaid;
                }
            }

            $invoice->save() != true ? $isSaved = false : '';

            if ($data['return_price'] > 0){
                $category = ExpenseCategory::where('type', Status::$default)->first();
                $newExpenses = new Expense();
                $newExpenses->title = 'The drug was returned to the customer. Invoice ID: '. $invoice->id;
                $newExpenses->expense_category_id  = $category->id;
                $newExpenses->date  = date("Y-m-d");
                $newExpenses->clinic_id  = auth()->user()->clinic_id;
                $newExpenses->currency_id  = $invoice->currency_id;
                $newExpenses->amount  = $data['return_price'];
                $newExpenses->save() != true ? $isSaved = false : '';
            }

            if ($isSaved){
                DB::commit();
                return [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Success',
                    'data' => new $this->resource($invoice)
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
