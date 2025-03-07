<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
