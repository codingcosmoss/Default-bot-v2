<?php

namespace App\Http\Resources;

use App\Models\CollectionProduct;
use App\Models\ImportedProduct;
use App\Models\Treatment;
use App\Models\TreatmentService;
use App\Models\UsedProduct;
use App\Traits\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $usedProducts = UsedProduct::where('product_id', $this->id)->sum('amount');
        $importedProducts = ImportedProduct::where('product_id', $this->id)->sum('amount');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'price_format' => Action::decimal($this->price),
            'bar_code' => $this->bar_code,
            'vendor_code' => $this->vendor_code,
            'group_id' => $this->group_id,
            'group' => $this->group->name,
            'size_type' => $this->size_type,
            'min_amount' => $this->min_amount,
            'rest_products' => $importedProducts - $usedProducts,
        ];
    }
}
