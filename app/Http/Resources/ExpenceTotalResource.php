<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenceTotalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currency = Currency::find($this->currency_id);
        return [
            'title' => $currency->title,
            'name' => $currency->name,
            'sign' => $currency->sign,
            'currency_id' => $this->currency_id,
            'total_amount' => $this->total_amount
        ];
    }
}
