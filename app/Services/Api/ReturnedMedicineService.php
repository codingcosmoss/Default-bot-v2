<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\ImportedMedicineResource;
use App\Http\Resources\ReturnedMedicineResource;
use App\Models\BoxSize;
use App\Models\ClinicUser;
use App\Models\Currency;
use App\Models\Document;
use App\Models\DocumentPayment;
use App\Models\ImportedMedicine;
use App\Models\Medicine;
use App\Models\MedicineCategory;
use App\Models\ReturnedMedicine;
use App\Traits\Status;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Token\Stack;


class ReturnedMedicineService extends AbstractService
{
    protected $model = ReturnedMedicine::class;
    protected $resource = ReturnedMedicineResource::class;
    protected $columns = ['created_at'];
    protected $menu = 'ReturnedMedicines';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('document_id')->setRules('required|integer'),
            TextField::make('returned_amount')->setRules('required|numeric'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('payment_type_id')->setRules('nullable|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
            TextField::make('returned_price')->setRules('required|numeric'),
            TextField::make('medicine')->setRules('required'),
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
            TextField::make('returned_price')->setRules('required|numeric'),
            TextField::make('medicine')->setRules('required'),
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
            $sum = 0;
            $medicine = $data['medicine'];
            $thisMedicine = Medicine::find($medicine['medicine_id']);
            $newModel = new ReturnedMedicine();
            $newModel->clinic_id = $data['clinic_id'];
            $newModel->document_id = $data['document_id'];
            $newModel->supplier_id = $data['supplier_id'];
            $newModel->warehouse_id = $data['warehouse_id'];
            $newModel->box_size_id = $medicine['box_size_id'];
            $newModel->medicine_id = $medicine['medicine_id'];
            $newModel->amount = $data['returned_amount'];
            $newModel->buy_price = $medicine['buy_price'];
            $newModel->total_cost = $medicine['buy_price'] * $data['returned_amount'];
            $newModel->expiry_date_finished = $medicine['expiry_date_finished'];
            $newModel->currency_id = $data['currency_id'];
            $newModel->save() != true ? $isSaved = false : '';

            $importedMedicine = ImportedMedicine::find($medicine['id']);
            $importedMedicine->amount = $importedMedicine->amount - $data['returned_amount'];
            $importedMedicine->total_cost = $importedMedicine->total_cost - $newModel->total_cost;
            $importedMedicine->save() != true ? $isSaved = false : '';

            $subtotal += $newModel->total_cost;
            $thisMedicine->changeAmount(Status::$returned, $newModel) == false ? $isSaved = false : '';

            $document->subtotal -= $subtotal;
            $document->amount_paid -= $data['returned_price'];
            $document->loan_amount = $document->loan_amount - $subtotal + $data['returned_price'];
            if ( $document->amount_paid <  0){
                $document->amount_paid = 0;
            }
            if ( $document->loan_amount <  0){
                $document->loan_amount = 0;
            }
            $document->currency_id = $data['currency_id'];
            $document->save() != true ? $isSaved = false : '';

            if ($data['returned_price']>0)
            {
                $payments = DocumentPayment::where('document_id', $document->id)
                    ->get();
                $returnedPrice = $data['returned_price']; // 5000
                foreach ($payments as $payment)
                {
                    if ($returnedPrice != 0){
                        $thisPayment = DocumentPayment::find($payment->id);
                        if ($thisPayment->amount - $returnedPrice <= 0){
                            $returnedPrice -= $thisPayment->amount;
                            $thisPayment->amount = 0;
                            $thisPayment->save() != true ? $isSaved = false : '';
                        }else{
                            $thisPayment->amount -= $returnedPrice;
                            $thisPayment->save() != true ? $isSaved = false : '';
                            $returnedPrice = 0;
                        }
                    }else{
                        break;
                    }
                }
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

}
