<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function boxSize()
    {
        return $this->belongsTo(BoxSize::class);
    }

    public function sizeType()
    {
        return $this->belongsTo(SizeType::class);
    }

        public function drugCompany()
    {
        return $this->belongsTo(DrugCompany::class);
    }
}
