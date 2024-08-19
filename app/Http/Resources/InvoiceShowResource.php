<?php

namespace App\Http\Resources;

use App\Models\Clinic;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Setting;
use App\Models\SoldMedicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $customer = Customer::find($this->customer_id);
        $user = User::find($this->user_id);
        $soldMedicines = SoldMedicine::where('invoice_id', $this->id)->get();
        $company = Setting::where('clinic_id', $this->clinic_id)->first();
        return [
            'id' => $this->id,
            'clinic_id' => $this->clinic_id,
            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,
            'customer' => $customer,
            'user' => $user,
            'date' => $this->date,
            'amount' => $this->amount,
            'amount_paid' => $this->amount_paid,
            'must_paid' => $this->must_paid,
            'subtotal' => $this->subtotal,
            'igta' => $this->igta,
            'gst' => $this->gst,
            'currency_id' => $this->currency_id,
            'currency' => Currency::find($this->currency_id),
            'sold_medicines' => $soldMedicines,
            'company' => new SettingsResources($company)
        ];
    }
}
