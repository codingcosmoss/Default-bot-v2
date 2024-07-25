<?php

namespace App\Http\Resources;

use App\Models\Currency;
use App\Models\RemainingDrug;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportedMedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currentAmount = RemainingDrug::where('medicine_id', $this->medicine_id)
            ->where('clinic_id', $this->clinic_id)
            ->latest()->first();

        if (!$currentAmount){
            $currentAmount = 0;
        }else{
            $currentAmount = $currentAmount->amount;
        }
        return [
            'clinic_id' => $this->clinic_id,
            'document_id' => $this->document_id,
            'supplier_id' => $this->supplier_id,
            'warehouse_id' => $this->warehouse_id,
            'medicine_id' => $this->medicine_id,
            'box_size_id' => $this->box_size_id,
            'box_size' => $this->boxSize,
            'current_amount' => $currentAmount,
            'medicine' => new MedicineResource($this->medicine),
            'amount' => $this->amount,
            'buy_price' => $this->buy_price,
            'total_cost' => $this->total_cost,
            'expiry_date_finished' => $this->expiry_date_finished,
            'currency_id' => $this->currency_id,
            'currency' => Currency::find($this->currency_id),
        ];
    }
}
