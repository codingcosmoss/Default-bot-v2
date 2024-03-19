<?php

namespace App\Http\Resources;

use App\Traits\Action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilialResource extends JsonResource
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
            'name' => $this->name,
            'warehouses' => count($this->warehouses),
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' =>  Carbon::parse($this->updated_at)->format('Y-m-d H:i'),
        ];
    }
}
