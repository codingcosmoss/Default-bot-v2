<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'name_uz' => $this->name_uz,
            'name_ru' => $this->name_ru,
            'category_id' => $this->category_id,
            'category' => Group::find($this->category_id),
            'products' => Product::where('brand_id' , $this->id)->get(),
        ];
    }
}
