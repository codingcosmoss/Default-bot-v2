<?php

namespace App\Http\Resources;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\PaymentType;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierPaymentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = parent::toArray($request);
        $arr['user'] = User::withoutTrashed()->find($this->user_id);
        $arr['supplier'] = Supplier::withoutTrashed()->find($this->supplier_id);
        $arr['payment_type'] = PaymentType::withoutTrashed()->find($this->payment_type_id);
        $arr['currency'] = Currency::find($this->currency_id);
        return $arr;
    }
}
