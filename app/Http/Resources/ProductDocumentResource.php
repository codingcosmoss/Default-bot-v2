<?php

namespace App\Http\Resources;

use App\Models\ImportedProduct;
use App\Models\ProductDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totals = ImportedProduct::where('product_document_id', $this->id)->get();
        $summ = 0;
        foreach ($totals as $total){
            $summ += $total->price * $total->amount;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => $this->user->name,
            'user_id' => $this->user_id,
            'supplier' => $this->supplier->name,
            'supplier_id' => $this->supplier_id,
            'warehouse' => $this->warehouse->name,
            'warehouse_id' => $this->warehouse->id,
            'summ' => $summ,
            'status' => $this->status,
            'created_at' =>  date('Y-m-d H:i', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d H:i', strtotime($this->updated_at)),
        ];
    }
}
