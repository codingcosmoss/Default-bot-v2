<?php

namespace App\Http\Resources;

use App\Models\ImportedMedicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class WarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $importMedicinePrices = ImportedMedicine::where('clinic_id', $this->clinic_id)
            ->where('warehouse_id', $this->id)
            ->select('currency_id', DB::raw('SUM(total_cost) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'impoted_medicines_count' => ImportedMedicine::where('warehouse_id', $this->id)->sum('amount'),
            'importMedicinePrices' => ExpenceTotalResource::collection($importMedicinePrices),
            'status' => $this->status,
        ];
    }
}
