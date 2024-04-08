<?php

namespace App\Http\Resources;

use App\Models\Payment;
use App\Models\Treatment;
use App\Models\TreatmentService;
use App\Traits\Action;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $models = Payment::join('patients', 'payments.patient_id', '=', 'patients.id')
            ->select('payments.*', 'patients.first_name', 'patients.last_name')
            ->orderBy('payments.updated_at', 'desc')
            ->where('payments.patient_id', $this->id)
            ->paginate(10);

        $data = [
            'items' => PaymentResource::collection($models),
            'pagination' => [
                'total' => $models->total(),
                'per_page' => $models->perPage(),
                'current_page' => $models->currentPage(),
                'last_page' => $models->lastPage(),
                'from' => $models->firstItem(),
                'to' => $models->lastItem(),
            ],
        ];
        $treatmens = Treatment::where('patient_id', $this->id)->get();
        $debtAmount = 0;
        $services = [];

        foreach ($treatmens as $treatment){
            $debtAmount += $treatment->service_real_price - $treatment->discount_sum;

            $treatmentServices = TreatmentService::where('treatment_id', $treatment->id)
                ->get();

            // Har bir treatmentServices massivini $services massiviga qo'shamiz
            $services = array_merge($services, $treatmentServices->toArray());
        }


        $paymentSum = Payment::where('patient_id', $this->id )->sum('amount');
        $realPrice = $debtAmount - $paymentSum;
        $defaultImage = [
            [
                'url' => asset('').'Photos/patient.webp'
            ]
        ];
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'job' => $this->job,
            'address' => $this->address,
            'gender' => $this->gender,
            'gender_text' => Status::getStatusName($this->gender),
            'birthday' => $this->birthday,
            'price' =>  $this->price,
            'status' => $this->status,
            'diseases' => $this->diseases->map(function ($disease) {
                return ['id' => $disease->id, 'name' => $disease->name];
            })->toArray(),
            'treatmets' => TreatmentResource::collection($this->treatments),
            'payments' => $data,
            'sort_order' => $this->sort_order,
            'services_used' => count($services),
            'services' => $services,
            'balans' => $realPrice < 0 ? Action::decimal(abs($realPrice)).' '.'uzs' : '0 uzs',
//            'debts' =>  Action::decimal($realPrice).' '.'uzs' ,
            'debts' => $realPrice > 0 ? Action::decimal($realPrice).' '.'uzs' : '0 uzs',
            'amount_paid' => Action::decimal($paymentSum).' '.'uzs',
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => $this->updated_at,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,


        ];
    }
}
