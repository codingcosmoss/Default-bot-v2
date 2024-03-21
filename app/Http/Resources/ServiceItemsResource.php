<?php

namespace App\Http\Resources;

use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\ImportedProduct;
use App\Models\PersonalPrice;
use App\Models\Service;
use App\Models\Treatment;
use App\Models\UsedProduct;
use App\Traits\Action;
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
        $totalSum = Collection::find($service->collection_id) != null ? Collection::find($service->collection_id)->product_total_sum + $service->price : $service->price ;

        $collectionProducts = CollectionProduct::join('products', 'products.id', 'collection_products.product_id')
            ->select('products.*', 'collection_products.amount')
            ->where('products.deleted_at', null)
            ->where('collection_products.collection_id', $service->collection_id)
            ->get();

        $max_count = 0;
        $arr = [];
        $treatmentId = session('treatment_id');
        $productError = false;
        if (count($collectionProducts) > 0){
            foreach ($collectionProducts as $product){
                $usedProducts = UsedProduct::where('treatment_id','!=', $treatmentId )->where('product_id', $product->id)->sum('amount');
                $importedProducts = ImportedProduct::where('product_id', $product->id)->sum('amount');
                $rest_products = intval($importedProducts - $usedProducts);
                if ($rest_products > 0){
                    $arr[] = [intval( $rest_products / $product->amount)];
//                    $max_count = $product->name.'//'. $rest_products. '//'. $product->id;

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
            'id' => $this->service_id,
            'count' => $this->amount,
            'service_id' => $this->service_id,
            'treatment_id' => $this->treatment_id,
            'name' => isset($service) ? $service->name : '' ,
            'price' => isset($service) ? $service->price : '' ,
            'service_total_sum' => $totalSum,
            'collection' => new CollectionResorces(Collection::find($service->collection_id)),
            'doctor_total_sum' => PersonalPrice::where('employee_id', $treatment->user_id)->where('service_id',$this->service_id )->sum('result_price'),
        ];
    }
}
