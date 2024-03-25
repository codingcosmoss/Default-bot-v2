<?php

namespace App\Http\Resources;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyCostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'payment_type' => $this->payment_type,
            'amount' => $this->amount,
            'date' => $this->date,
            'payment_type_name' => PaymentType::find($this->payment_type) != null ? PaymentType::find($this->payment_type)->name : '---',
        ];
    }
}
