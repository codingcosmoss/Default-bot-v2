<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedMedicine extends Model
{
    use HasFactory;

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function boxSize()
    {
        return $this->belongsTo(BoxSize::class);
    }
}
