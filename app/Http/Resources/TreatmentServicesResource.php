<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'treatment_id' => $this->treatment_id,
                'service_id' => $this->service_id,
                'amount' => $this->amount,
                'status' => $this->status,
                'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
                'updated_at' => $this->updated_at,
                'result_price' => $this->result_price,
                'service_name' => $this->service_name,
            ];
    }
}
