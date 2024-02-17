<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'job' => $this->job,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,

            'price' => $this->price,
            'status' => $this->status,
            'diseases' => $this->diseases->map(function ($disease) {
                return ['id' => $disease->id, 'name' => $disease->name];
            })->toArray(),
            'sort_order' => $this->sort_order,
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => $this->updated_at


        ];
    }
}
