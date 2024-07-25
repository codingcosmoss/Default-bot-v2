<?php

namespace App\Http\Resources;

use App\Models\Currency;
use App\Models\MedicineCategory;
use App\Models\RemainingDrug;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultImage = [
            [
                'url' => asset('').'Photos/medicine.png'
            ]
        ];
        $madel = RemainingDrug::where('medicine_id', $this->id)->latest()->first();
        $currency =  Currency::find($this->currency_id);
        $realAmount = 0;
        if ($madel){
            $realAmount = $madel->amount;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'medicine_category_id' => $this->medicine_category_id,
            'medicine_category_name' => MedicineCategory::find($this->medicine_category_id)->name ?? '---',
            'box_size_id' => $this->box_size_id,
            'box_size' => isset($this->boxSize) ? $this->boxSize->size : 1,
            'size_type' => isset($this->sizeType) ? $this->sizeType->name : 'piece',
            'size_type_id' => $this->size_type_id,
            'drug_company' => isset($this->drugCompany) ? $this->drugCompany->name : '',
            'drug_company_id' => $this->drug_company_id,
            'generic_name' => $this->generic_name,
            'buy_price' => $this->buy_price,
            'price' => $this->price,
            'qr_code' => $this->qr_code,
            'hns_code' => $this->hns_code,
            'desc' => $this->desc,
            'strength' => $this->strength,
            'shelf' => $this->shelf,
            'vat' => $this->vat,
            'igta' => $this->igta,
            'status' => $this->status,
            // Logical
            'amount' => $realAmount,
            'percentage' => intval($this->percentage),
            'selling_price' => intval($this->selling_price),
            'currency' => $currency
        ];
    }
}
