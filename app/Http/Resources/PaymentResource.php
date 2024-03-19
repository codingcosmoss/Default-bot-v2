<?php

namespace App\Http\Resources;

use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Treatment;
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
        $treatment = Treatment::find($this->treatment_id);
        $amount = $treatment->service_real_price - Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->treatment_id )->sum('amount');
        $realPrice = $amount - $treatment->discount_sum;
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patient_id' => $this->patient_id,
            'amount' => Action::decimal($this->amount).' UZS',
            'amount_number' => $this->amount,
            'treatment_id' => $this->treatment_id,
            'payment_type' => $this->paymentType->name,
            'color' => $this->paymentType->color,
            'real_price' => $realPrice,
            'payment_type_id' => $this->payment_type_id,
            'created_at' =>  date('Y-m-d H:i', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d H:i', strtotime($this->updated_at)),
        ];


    }
}
