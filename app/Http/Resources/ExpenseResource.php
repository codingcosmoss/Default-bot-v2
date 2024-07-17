<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'amount' => $this->amount,
            'date' => $this->date,
            'category' => $this->expenseCategory->name,
            'currency' => $this->currency,
            'currency_id' => $this->currency->id,
            'category_id' => $this->expenseCategory->id,
        ];
    }
}
