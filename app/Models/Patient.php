<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'patient_diseases', 'patient_id','disease_id' );
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getGenderName()
    {
        return Arr::get(self::genders(), $this->gender);
    }

    public static function genders()
    {
//        return [
//            self::$gender_male => __('words.male'),
//            self::$gender_female => __('words.female'),
//        ];

        return [
            self::$gender_male => 'Erkak',
            self::$gender_female => 'Ayol',
        ];
    }

    public static $gender_female = 'female';

    public static $gender_male = 'male';


}
