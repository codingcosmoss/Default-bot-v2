<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\returnArgument;

class Expense extends Model
{
    use HasFactory;

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
