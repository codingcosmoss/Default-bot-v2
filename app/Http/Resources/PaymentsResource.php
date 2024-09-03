<?php

namespace App\Http\Resources;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\PaymentType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = parent::toArray($request);
        $arr['user'] = User::withTrashed()->find($this->user_id);
        $arr['customer'] = Customer::withTrashed()->find($this->customer_id);
        $arr['payment_type'] = PaymentType::withTrashed()->find($this->payment_type_id);
        $arr['currency'] = Currency::find($this->currency_id);
        return $arr;
    }
}
