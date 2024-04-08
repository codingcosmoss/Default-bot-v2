<?php

namespace App\Http\Resources;

use App\Models\TreatmentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopServiceResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $count = TreatmentService::where('service_id', $this->id)->sum('amount');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'amount' => $count
        ];
    }
}
