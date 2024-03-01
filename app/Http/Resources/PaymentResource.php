<?php

namespace App\Http\Resources;

use App\Models\PaymentType;
use App\Traits\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'amount' => Action::decimal($this->amount).' UZS',
            'payment_type' => $this->paymentType->name,
            'color' => $this->paymentType->color,
            'payment_type_id' => $this->payment_type_id,
            'created_at' =>  date('Y-m-d H:i', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d H:i', strtotime($this->updated_at)),
        ];


    }
}
