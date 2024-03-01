<?php

namespace App\Http\Resources;

use App\Models\Payment;
use App\Traits\Action;
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

        $amountPaid = Payment::where('patient_id', $this->id)->sum('amount');


        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'job' => $this->job,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'price' =>  $this->price,
            'status' => $this->status,
            'diseases' => $this->diseases->map(function ($disease) {
                return ['id' => $disease->id, 'name' => $disease->name];
            })->toArray(),
            'treatmets' => TreatmentResource::collection($this->treatments),
            'payments' => $data,
            'sort_order' => $this->sort_order,
            'services_used' => 0,
            'amount_paid' => Action::decimal($amountPaid).' '.'UZS',
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'updated_at' => $this->updated_at


        ];
    }
}
