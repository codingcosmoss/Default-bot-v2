<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanySettingResource extends JsonResource
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
                'url' => 'https://www.shareicon.net/download/2015/08/10/83195_photos_1024x1024.png'
            ]
        ];
        return [
            'id' => $this->id,
            'logo' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'name' => $this->name,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'email' => $this->email,
            'address' => $this->address,
            'bot_token' => $this->bot_token,
            'printer_size' => $this->printer_size,
        ];
    }
}
