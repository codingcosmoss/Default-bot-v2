<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultImage = [
            [
                'url' => asset('').'Photos/user.png'
            ]
        ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'address' => $this->address,
            'phone' => $this->phone,
        ];
    }
}
