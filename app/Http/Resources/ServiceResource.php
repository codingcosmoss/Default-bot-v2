<?php

namespace App\Http\Resources;

use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\PersonalPrice;
use App\Models\ServiceCategory;
use App\Traits\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalSum = Collection::find($this->collection_id) != null ? Collection::find($this->collection_id)->product_total_sum + $this->price : $this->price ;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'price' =>  Action::decimal($this->price),
            'category_id' => $this->category_id,
            'category' => ServiceCategory::withTrashed()
                ->where('id', $this->category_id)
                ->select('name')
                ->first(),
            'material_price' => Action::decimal($this->material_price),
            'technic_price' => Action::decimal($this->technic_price),
            'order' => $this->order,
            'status' => $this->status,
            'service_total_sum' => Action::decimal($totalSum),
            'collection_id' => $this->collection_id,
            'personalPrices' => PersonalPrice::where('service_id', $this->id )->get()
        ];
    }
}
