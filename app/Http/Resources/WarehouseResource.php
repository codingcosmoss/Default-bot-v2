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
        $latestEntries = DB::table('remaining_drugs')
            ->select('id', 'medicine_id', 'amount')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('remaining_drugs')
                    ->groupBy('medicine_id');
            })
            ->get();

        $totalAmount = $latestEntries->sum('amount');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'impoted_medicines_count' => ImportedMedicine::where('warehouse_id', $this->id)->sum('amount'),
            'current_medicines_count' => $totalAmount,
            'status' => $this->status,
        ];
    }
}
