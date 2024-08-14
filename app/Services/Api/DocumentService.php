<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\ImportedMedicineResource;
use App\Models\Document;
use App\Models\ImportedMedicine;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class DocumentService extends AbstractService
{
    protected $model = Document::class;
    protected $resource = DocumentResource::class;
    protected $columns = ['date'];
    protected $menu = 'Documents';
    protected $isClinic = true; // Clinikalarga bog'liqmi yoki yo'qmi


    public function storeFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('user_id')->setRules('nullable'),

            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('date')->setRules('required|date'),
            TextField::make('subtotal')->setRules('nullable'),
            TextField::make('amount_paid')->setRules('nullable'),
            TextField::make('currency_id')->setRules('nullable'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('date')->setRules('required|date'),
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

            if ($this->isClinic){
                $models = $this->model::where('clinic_id', auth()->user()->clinic_id)
                    ->orderBy('updated_at', 'desc')
                    ->paginate($count);
            }else{
                $models = $this->model::orderBy('updated_at', 'desc')
                    ->paginate($count);
            }


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

    public function store(array $data, $file=null ): array
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
            $fileValidator = $this->dataValidator($data, $this->documentFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator'],
                ];
            }elseif ($fileValidator['status']){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $fileValidator['validator']
                ];
            }

            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['user_id'] = auth()->user()->id;
            $data['subtotal'] = isset($data['subtotal']) ?? 0;
            $data['amount_paid'] = isset($data['amount_paid']) ?? 0;
            $data['currency_id'] = Setting::where('clinic_id', auth()->user()->clinic_id)->first()->currency_id;

            $object = new $this->model;
            foreach ($this->storeFields() as $field) {
                $field->fill($object, $data);
            }
            $object->save();

            if (!$fileValidator['status']) {
                $this->uploadImagesOne($object, $file);
            }

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

    public function update(array $data, $id, $file=null)
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
            $fileValidator = $this->dataValidator($data, $this->documentFields());

            if ($validator['status']) {
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $validator['validator']
                ];
            }elseif ($fileValidator['status']){
                return [
                    'status' => false,
                    'code' => 422,
                    'message' => 'Validator error',
                    'errors' => $fileValidator['validator']
                ];
            }

            $data = $validator['data'];
            $data['clinic_id'] = auth()->user()->clinic_id;
            $data['user_id'] = auth()->user()->id;
            $data['subtotal'] = isset($data['subtotal']) ?? 0;
            $data['amount_paid'] = isset($data['amount_paid']) ?? 0;
            $data['currency_id'] = Setting::where('clinic_id', auth()->user()->clinic_id)->first()->currency_id;

            foreach ($this->updateFields() as $field) {
                $field->fill($item, $data);
            }
            $item->save();
            if (!$fileValidator['status']) {
                $this->uploadImagesOne($item, $file);
            }

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
