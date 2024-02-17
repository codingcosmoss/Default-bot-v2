<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'job' => $this->job,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'price' => $this->price,
            'status' => $this->status,
            'first_name' => $this->first_name,
            'diseases' => $this->diseases->pluck('id')->toArray(),


        ];
    }
}
