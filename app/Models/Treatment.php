<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function services()
    {
        return $this->hasMany(TreatmentService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

