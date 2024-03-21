<?php

namespace App\Http\Resources;

use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\ImportedProduct;
use App\Models\PersonalPrice;
use App\Models\ServiceCategory;
use App\Models\UsedProduct;
use App\Traits\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceAddResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $totalSum = Collection::find($this->collection_id) != null ? Collection::find($this->collection_id)->product_total_sum + $this->price : $this->price ;

        $collectionProducts = CollectionProduct::join('products', 'products.id', 'collection_products.product_id')
            ->select('products.*', 'collection_products.amount')
            ->where('products.deleted_at', null)
            ->where('collection_products.collection_id', $this->collection_id)
            ->get();

        $max_count = 0;
        $arr = [];
        $productError = false;
        $treatmentId = session('treatment_id');
        if (count($collectionProducts) > 0){
            foreach ($collectionProducts as $product){
                $usedProducts = UsedProduct::where('treatment_id','!=',  intval($treatmentId) )->where('product_id', $product->id)->sum('amount');
                $importedProducts = ImportedProduct::where('product_id', $product->id)->sum('amount');
                $rest_products = $importedProducts - $usedProducts;
                $max_count = $importedProducts;
                if ( $rest_products > 0 ){
                    $arr[] = [intval( $rest_products / $product->amount)];

                }else{
                    $arr[] = [0];
                }
            }
            $max_count = min($arr)[0];
        }else{
            $max_count = 1000;
        }

        return [
            'max_count' => $max_count,
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
            'personalPrices' => PersonalPrice::where('service_id', $this->id )->get(),
        ];;
    }
}
