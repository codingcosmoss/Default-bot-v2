<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\DocumentPaymentResource;
use App\Models\ClinicUser;
use App\Models\Document;
use App\Models\DocumentPayment;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class DocumenPaymentService extends AbstractService
{
    protected $model = DocumentPayment::class;
    protected $resource = DocumentPaymentResource::class;
    protected $columns = ['amount'];
    protected $menu = 'DocumentPayments';
    protected $isClinic = false; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('user_id')->setRules('nullable'),

            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('document_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|numeric'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('user_id')->setRules('nullable'),

            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('document_id')->setRules('required|integer'),
            TextField::make('amount')->setRules('required|numeric'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
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

            DB::beginTransaction();
            $isSave = true;
            $object = new $this->model;
            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save() != true ? $isSave = false : '';

            $document = Document::find($data['document_id']);
            $document->loan_amount = $document->loan_amount -  $data['amount'];
            $document->amount_paid = $document->amount_paid +  $data['amount'];
            $document->save() != true ? $isSave = false : '';

            if ($isSave){
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
                    'message' => 'Base error',
                    'errors' => []
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
            $data['user_id'] = auth()->user()->id;

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
