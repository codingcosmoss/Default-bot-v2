<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function anketas()
    {
        return $this->hasMany(ServiceAnketa::class, 'service_id', 'id');
    }

    public function getSeriveBadgeAnkets()
    {
        $text = '';
        foreach ($this->anketas as $anketa) {
            $text .= " <span class='badge badge-secondary'>" . $anketa->getAnketaName() . "</span>";
        }
        return $text;
    }

}
