<?php

namespace App\Http\Resources;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['medicine'] = Medicine::withoutTrashed()->where('id', $data['medicine_id'])->first();
        return $data;
    }
}
