<?php

namespace App\Models;

use App\Services\Api\GroupService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public static $rules = [
        'product_id' => 'required|integer',
        'amount' => 'required|integer',
        'size_type' => 'required|string',
    ];

    // Yoki
    public function rules()
    {
        return static::$rules;
    }
}
