<?php

namespace App\Http\Resources;

use App\Models\Discount;
use App\Models\Patient;
use App\Models\Payment;
use App\Traits\Status;
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
        if ($this->payment_status != Status::$Closed){
            $amount = $this->service_real_price - Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->sum('amount');
            $realPrice = $amount - $this->discount_sum;
        }else{
            $realPrice = 0;
        }

        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'patient' => $this->patient,
            'doctor_id' => $this->user_id,
            'doctor' => $this->user,
            'start' => $this->start,
            'end' => $this->end,
            'test' =>  $this->service_real_price - Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->sum('amount'),
            'status' => $this->status,
            'payment_status' => $this->payment_status ,
            'user_payment' => $realPrice,
            'payment_amount' => Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->sum('amount') , // To'lanadigan miqdor
            'discount_total_sum' => $this->discount_total_sum, // Berilgan chegirma miqdor
            'service_real_price' => $this->service_real_price, // Xizimat narxi
            'payment_type' => $this->payment_type, // Payment type
            'discount_percent' => $this->discount_percent,
            'discount_sum' => $this->discount_sum,
            'type_of_discount' => $this->type_of_discount,
            'latest_payment' => count($payments) > 0 ?  new  PaymentResource(Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->latest()->first()) : null ,
        ];
    }
}
