<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function filial()
    {
        return $this->belongsTo(Filial::class);
    }

    public function category()
    {
        return $this->belongsTo(WarehouseCategory::class);
    }

}
