<?php

namespace App\Http\Resources;

use App\Models\Patient;
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
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'patient' => $this->patient,
            'start' => $this->start,
            'status' => $this->status,
            'user_payment' => $this->user_payment,
            'payment_amount' => $this->payment_amount,
        ];
    }
}
