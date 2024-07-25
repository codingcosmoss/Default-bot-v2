<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultFile = [
            [
                'url' => ''
            ]
        ];

        return [
            'id' => $this->id,
            'clinic_id' => $this->clinic_id,
            'user_id' => $this->user_id,
            'document_id' => $this->document_id,
            'warehouse' => $this->warehouse,
            'warehouse_id' => $this->warehouse_id,
            'supplier_id' => $this->supplier_id,
            'supplier' => $this->supplier,
            'date' => $this->date,
            'subtotal' => $this->subtotal,
            'loan_amount' => $this->loan_amount,
            'amount_paid' => $this->amount_paid,
            'status' => $this->status,
            'currency' => Currency::find($this->currency_id),
            'file' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultFile ,

        ];
    }
}
