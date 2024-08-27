<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\ImportedMedicineResource;
use App\Models\Batch;
use App\Models\BoxSize;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\Document;
use App\Models\DocumentPayment;
use App\Models\ImportedMedicine;
use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Traits\Status;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Token\Stack;


class ImportedMedicineService extends AbstractService
{
    protected $model = ImportedMedicine::class;
    protected $resource = ImportedMedicineResource::class;
    protected $columns = ['amount'];
    protected $menu = 'ImportedMedicines';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('document_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('payment_type_id')->setRules('nullable|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
            TextField::make('amount_paid')->setRules('required|numeric'),
            TextField::make('medicines')->setRules('required'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('document_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
            TextField::make('amount_paid')->setRlues('required|numeric'),
            TextField::make('medicines')->setRules('required'),
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
            $data['payment_type_id'] = isset($data['payment_type_id']) ? $data['payment_type_id'] : null;
            DB::beginTransaction();
            $isSaved = true;
            $document = Document::find($data['document_id']);
            $subtotal = 0;
            foreach ($data['medicines'] as $medicine){
                $thisMedicine = Medicine::find($medicine['id']);

                if ($thisMedicine->buy_price != $medicine['buy_price'] || $thisMedicine->box_size_id != $medicine['box_size_id']){
                    $sumPrice = ($medicine['buy_price']*$thisMedicine->percentage)/100;
                    $box = BoxSize::find($medicine['box_size_id']);
                    $currency = Currency::find($data['currency_id']);
                    $newMedicine = $thisMedicine->replicate();
                    $newMedicine->generic_name = $thisMedicine->generic_name. ' '.$this->formatNumber($medicine['buy_price'] + $sumPrice).$currency->sign .' ('.$box->name.')';
                    $newMedicine->buy_price = $medicine['buy_price'];
                    $newMedicine->selling_price = $sumPrice;
                    $newMedicine->price = $medicine['buy_price'] + $sumPrice;
                    $newMedicine->box_size_id = $medicine['box_size_id'];
                    $newMedicine->parent_id = $thisMedicine->id;
                    $newMedicine->save() != true ? $isSaved != false : '';

                    // Eski medicine obyektining rasmlarini olamiz
                    $existingImages = $thisMedicine->image;
                    if ($existingImages != null){
                        foreach ($existingImages as $image) {
                            // Yangi rasm yaratamiz
                            $newImage = $image->replicate();
                            // Yangi medicine ob'ektiga bog'laymiz
                            $newImage->imageable_id = $newMedicine->id;
                            // Yangi rasmni saqlaymiz
                            $newImage->save();
                        }
                    }
                    $thisMedicine = $newMedicine;

                }

                $newBatch = new Batch();
                $newBatch->name = $medicine['batch_name'];
                $newBatch->clinic_id = $document->clinic_id;
                $newBatch->medicine_id = $medicine['id'];
                $newBatch->document_id = $document->id;
                $newBatch->amount = $medicine['buy_amount'];
                $newBatch->expiry_date_finished = $medicine['expiry_date_finished'];
                $newBatch->save() != true ? $isSaved = false : '';

                $newModel = new ImportedMedicine();
                $newModel->clinic_id = $data['clinic_id'];
                $newModel->document_id = $data['document_id'];
                $newModel->supplier_id = $data['supplier_id'];
                $newModel->warehouse_id = $data['warehouse_id'];
                $newModel->box_size_id = $medicine['box_size_id'];
                $newModel->medicine_id = $medicine['id'];
                $newModel->amount = $medicine['buy_amount'];
                $newModel->buy_price = $medicine['buy_price'];
                $newModel->total_cost = $medicine['buy_price'] * $medicine['buy_amount'];
                $newModel->expiry_date_finished = $medicine['expiry_date_finished'];
                $newModel->currency_id = $data['currency_id'];
                if (!$newModel->save()){
                    $isSaved = false;
                    break;
                }
                $newBatch->imported_medicine_id = $newModel->id;
                $newBatch->save() != true ? $isSaved = false : '';

                $subtotal += $newModel->total_cost;

                $thisMedicine->changeAmount(Status::$import, $newModel);
            }

            $document->subtotal = $subtotal;
            $document->amount_paid = $data['amount_paid'];
            $document->loan_amount = $subtotal - $data['amount_paid'];
            $document->currency_id = $data['currency_id'];
            $document->status = Status::$saved;
            $document->save() != true ? $isSaved = false : '';

            if ($data['amount_paid'] > 0){
                $payment = new DocumentPayment();
                $payment->clinic_id = $data['clinic_id'];
                $payment->document_id = $document->id;
                $payment->supplier_id = $data['supplier_id'];
                $payment->user_id = auth()->user()->id;
                $payment->amount = $data['amount_paid'];
                $payment->payment_type_id = $data['payment_type_id'];
                $payment->currency_id = $data['currency_id'];
                $payment->save() != true ? $isSaved = false : '';
            }

            if ($isSaved){
                DB::commit();
                return [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Success',
                    'data' => null
                ];
            }else{
                DB::rollBack();
                return [
                    'status' => false,
                    'code' => 403,
                    'message' => 'Document error !',
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
                ->where('document_id', $id)
                ->get();

            return [
                'status' => true,
                'code' => 200,
                'message' => 'Success',
                'data' =>  $this->resource::collection($data)
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

    public function supplierMedicines($supplier_id)
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
                ->where('supplier_id', $supplier_id)
                ->orderBy('id', 'asc')
                ->paginate(10);


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

}
