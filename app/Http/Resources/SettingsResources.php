<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResources extends JsonResource
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
                'url' => asset('').'Photos/file.png'
            ]
        ];
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'currency' => $this->currency,
            'currency_id' => $this->currency->id,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,

        ];
    }
}
