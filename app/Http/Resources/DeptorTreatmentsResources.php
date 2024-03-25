<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeptorTreatmentsResources extends JsonResource
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
            'patient_name' => $this->patient->first_name. ' ' .$this->patient->last_name,
            'doctor_sum' => $this->doctor_result_sum,
            'start' => $this->start,
        ];
    }
}
