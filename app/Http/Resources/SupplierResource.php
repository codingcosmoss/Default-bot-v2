<?php

namespace App\Http\Resources;

use App\Models\Currency;
use App\Models\Document;
use App\Models\DocumentPayment;
use App\Models\Expense;
use App\Models\ImportedMedicine;
use App\Models\Setting;
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

        $paidGroupedByCurrency = Document::where('clinic_id', auth()->user()->clinic_id)
            ->where('supplier_id', $this->id)
            ->select('currency_id', DB::raw('SUM(amount_paid) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        $loanGroupedByCurrency = Document::where('clinic_id', auth()->user()->clinic_id)
            ->where('supplier_id', $this->id)
            ->select('currency_id', DB::raw('SUM(loan_amount) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        if ($paidGroupedByCurrency->isEmpty() || $loanGroupedByCurrency->isEmpty()) {
            $currency_id = Setting::where('clinic_id', $this->clinic_id)->first()->currency_id;

            if ($paidGroupedByCurrency->isEmpty()) {
                $paidGroupedByCurrency = collect([new \stdClass()]);
                $paidGroupedByCurrency[0]->total_amount = 0;
                $paidGroupedByCurrency[0]->currency_id = $currency_id;
            }

            if ($loanGroupedByCurrency->isEmpty()) {
                $loanGroupedByCurrency = collect([new \stdClass()]);
                $loanGroupedByCurrency[0]->total_amount = 0;
                $loanGroupedByCurrency[0]->currency_id = $currency_id;
            }
        }


        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'address' => $this->address,
            'phone' => $this->phone,
            'imported_medicines' => ImportedMedicine::where('supplier_id', $this->id)->sum('amount'),
            'paid' =>  ExpenceTotalResource::collection($paidGroupedByCurrency), // Tolandi
            'loan' =>  ExpenceTotalResource::collection($loanGroupedByCurrency) // Qarzdorlik
        ];
    }
}
