<?php

namespace App\Http\Resources;

use App\Models\DocumentPayment;
use App\Models\Expense;
use App\Models\ImportedMedicine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultImage = [
            [
                'url' => asset('').'Photos/user.png'
            ]
        ];

        $paidGroupedByCurrency = DocumentPayment::where('clinic_id', auth()->user()->clinic_id )
            ->where('supplier_id', $this->id)
            ->select('currency_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'address' => $this->address,
            'phone' => $this->phone,
            'imported_medicines' => ImportedMedicine::where('supplier_id', $this->id)->sum('amount'),
            'paid' =>  ExpenceTotalResource::collection($paidGroupedByCurrency)
        ];
    }
}
