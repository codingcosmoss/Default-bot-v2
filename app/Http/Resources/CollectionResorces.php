<?php

namespace App\Http\Resources;

use App\Models\CollectionProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResorces extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = CollectionProduct::where('collection_id', $this->id)
            ->join('products', 'collection_products.product_id', '=', 'products.id')
            ->select('products.name','products.id', 'products.price', 'products.size_type', 'collection_products.*' )
            ->get();
        $summ = 0;
        foreach ($products as $product){
            $summ += $product->price * $product->amount ;
        }


        return [
            'id' => $this->id,
            'name' => $this->name,
            'products' => $products,
            'summ' => $summ,
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
