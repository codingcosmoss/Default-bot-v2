<?php

namespace App\Http\Resources;

use App\Models\Discount;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\PaymentType;
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
        $paymentsAmount = Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->sum('amount');

        if ($this->payment_status != Status::$Closed){
            $amount = $this->service_real_price - $paymentsAmount;
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
            'payment_amount' => $paymentsAmount, // To'lanadigan miqdor
            'discount_total_sum' => $this->discount_total_sum, // Berilgan chegirma miqdor
            'service_real_price' => $this->service_real_price, // Xizimat narxi
            'payment_type' => $this->payment_type, // Payment type
            'doctor_result_sum' => $this->doctor_result_sum > 0 ? $this->doctor_result_sum : 0, //doctorning ulushi
            'discount_percent' => $this->discount_percent,
            'discount_sum' => $this->discount_sum,
            'technic_or_doctor_payment_type' =>  PaymentType::find($this->technic_or_doctor_payment_type) != null ? PaymentType::find($this->technic_or_doctor_payment_type)->name : '' ,
            'doctor_givey_money_at' => $this->doctor_givey_money_at,
            'material_price' => $this->material_price,
            'type_of_discount' => $this->type_of_discount,
            'indebtedness' => $this->discount_sum, // qarzdorlik
            'cancleted_description' => $this->cancleted_description,
            'latest_payment' => count($payments) > 0 ?  new  PaymentResource(Payment::where('patient_id',$this->patient_id )->where('treatment_id', $this->id )->latest()->first()) : null ,
        ];
    }
}
