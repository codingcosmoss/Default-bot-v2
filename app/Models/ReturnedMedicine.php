<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedMedicine extends Model
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
    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function document()
    {
        return $this->belongsTo(Document::class)->withTrashed();
    }

}
