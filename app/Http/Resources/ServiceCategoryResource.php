<?php

namespace App\Http\Resources;

use App\Models\Service;
use App\Traits\Action;
use App\Traits\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'status' => $this->status,
            'services' => Service::where('status', Status::$status_active)->where('category_id', $this->id)->select('services.name', 'services.id', 'services.price')->get()

        ];
    }
}
