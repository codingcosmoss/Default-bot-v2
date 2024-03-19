<?php

namespace App\Http\Resources;

use App\Models\Collection;
use App\Models\PersonalPrice;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $treatment = Treatment::find($this->treatment_id);
        $service = Service::find($this->service_id);

        return [
            'id' => $this->service_id,
            'count' => $this->amount,
            'service_id' => $this->service_id,
            'treatment_id' => $this->treatment_id,
            'name' => isset($service) ? $service->name : '' ,
            'price' => isset($service) ? $service->price : '' ,
            'collection' => new CollectionResorces(Collection::find($service->collection_id)),
            'doctor_total_sum' => PersonalPrice::where('employee_id', $treatment->user_id)->where('service_id',$this->service_id )->sum('result_price'),
        ];
    }
}
