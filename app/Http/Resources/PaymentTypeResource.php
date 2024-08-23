<?php

namespace App\Http\Resources;

use App\Models\DocumentPayment;
use App\Models\Expense;
use App\Models\SellingPayment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class PaymentTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = parent::toArray($request);
        $sellingPayments = SellingPayment::where('clinic_id', $this->clinic_id)
            ->where('payment_type_id', $this->id)
            ->select('currency_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        $documentPayments = DocumentPayment::where('clinic_id', $this->clinic_id)
            ->where('payment_type_id', $this->id)
            ->select('currency_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('currency_id')
            ->get();

        $combinedPayments = collect();

        $sellingPayments->each(function($payment) use ($combinedPayments) {
            $existingPayment = $combinedPayments->firstWhere('currency_id', $payment->currency_id);

            if ($existingPayment) {
                // Agar currency_id allaqachon mavjud bo'lsa, total_amountni qo'shamiz
                $existingPayment->total_amount += $payment->total_amount;
            } else {
                // Yangi obyektni qo'shamiz
                $combinedPayments->push($payment);
            }
        });

        $documentPayments->each(function($payment) use ($combinedPayments) {
            $existingPayment = $combinedPayments->firstWhere('currency_id', $payment->currency_id);

            if ($existingPayment) {
                $existingPayment->total_amount += $payment->total_amount;
            } else {
                $combinedPayments->push($payment);
            }
        });
        $isDelete = 1;
        if ($combinedPayments->isEmpty()) {
            $isDelete = 0;
            $currency_id = Setting::where('clinic_id', $this->clinic_id)->first()->currency_id;
            $combinedPayments = collect([new \stdClass()]);
            $combinedPayments[0]->total_amount = 0;
            $combinedPayments[0]->currency_id = $currency_id;
        }

        $arr['payments'] = ExpenceTotalResource::collection($combinedPayments);
        $arr['is_delete'] =$isDelete;
        return $arr;
    }
}
