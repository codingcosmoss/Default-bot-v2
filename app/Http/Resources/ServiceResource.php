<?php

namespace App\Http\Resources;

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
            'collection_id' => $this->collection_id,
            'personalPrices' => PersonalPrice::where('service_id', $this->id )->get()
        ];
    }
}
