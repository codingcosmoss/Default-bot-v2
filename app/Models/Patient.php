<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'patient_diseases', 'patient_id','disease_id' );
    }

}
