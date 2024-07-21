<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ClinicUserResource;
use App\Http\Resources\DocumentResource;
use App\Models\ClinicUser;
use App\Models\Document;


class DocumentService extends AbstractService
{
    protected $model = Document::class;
    protected $resource = DocumentResource::class;
    protected $columns = ['name'];
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
            TextField::make('subtotal')->setRules('required|numeric'),
            TextField::make('amount_paid')->setRules('required|numeric'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
        ];
    }
    public function updateFields()
    {
        return [
            TextField::make('clinic_id')->setRules('nullable'),
            TextField::make('user_id')->setRules('nullable'),

            TextField::make('warehouse_id')->setRules('required|integer'),
            TextField::make('supplier_id')->setRules('required|integer'),
            TextField::make('date')->setRules('required|date'),
            TextField::make('subtotal')->setRules('required|numeric'),
            TextField::make('amount_paid')->setRules('required|numeric'),
            TextField::make('payment_type_id')->setRules('required|integer'),
            TextField::make('currency_id')->setRules('required|integer'),
        ];
    }

}
