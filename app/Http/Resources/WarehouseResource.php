<?php

namespace App\Http\Resources;

use App\Models\WarehouseCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category =  WarehouseCategory::find($this->warehouse_category_id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'filial_id' => $this->filial_id,
            'filial' => isset($this->filial->name) > 0 ? $this->filial->name : '---'  ,
            'category_id' => $category->id,
            'category' => $category->name,
            'status' => $this->status,
        ];
    }
}
