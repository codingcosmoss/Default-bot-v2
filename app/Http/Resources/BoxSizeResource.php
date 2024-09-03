<?php

namespace App\Http\Resources;

use App\Models\BoxSize;
use App\Models\ImportedMedicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoxSizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $isImported = ImportedMedicine::where('box_size_id', $this->id)->first();
        if ($isImported){
            $data['is_delete'] = 1;
        }else{
            $data['is_delete'] = 0;
        }
        return $data;
    }
}
