<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disease extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_diseases', 'disease_id', 'patient_id');
    }
}
