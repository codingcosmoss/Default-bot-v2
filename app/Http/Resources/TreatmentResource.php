<?php

namespace App\Http\Resources;

use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $payments = Patient::find($this->patient_id)->payments;
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'patient' => $this->patient,
            'doctor_id' => $this->user_id,
            'doctor' => $this->user,
            'start' => $this->start,
            'end' => $this->end,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'user_payment' => $this->user_payment,
            'payment_amount' => $this->payment_amount, // To'lanadigan miqdor
            'discount_total_sum' => $this->discount_total_sum, // Berilgan chegirma miqdor
            'service_real_price' => $this->service_real_price, // Xizimat narxi
            'payment_type' => $this->payment_type, // Payment type
            'latest_payment' => count($payments) > 0 ?  new  PaymentResource(Payment::where('patient_id',$this->patient_id )->latest()->first()) : null ,
        ];
    }
}
