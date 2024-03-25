<?php

namespace App\Http\Resources;

use App\Models\Treatment;
use App\Traits\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesPaymentResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $finishedTreatments = Treatment::where('user_id', $this->id)
            ->where('is_give_money_doctor', '!=', Status::$Closed)
            ->where('payment_status', Status::$Closed)
            ->where('status', Status::$finished)
            ->get();

        $deptorTreatments = Treatment::where('user_id', $this->id)
            ->where('is_give_money_doctor', '!=', Status::$Closed)
            ->where('payment_status','!=', Status::$Closed)
            ->where('status', Status::$finished)
            ->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'finished_treatments' => DeptorTreatmentsResources::collection($finishedTreatments),
            'finished_count' => count($finishedTreatments),
            'deptor_count' => count($deptorTreatments),
            'deptor_treatments' => DeptorTreatmentsResources::collection($deptorTreatments),
        ];
    }
}
