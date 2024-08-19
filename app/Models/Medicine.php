<?php

namespace App\Models;

use App\Traits\Status;
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

    public function changeAmount($type, $data)
    {
        $newMadel = new RemainingDrug();

        if ($type == Status::$import){
            $latestRemainingDrug = RemainingDrug::where('medicine_id', $this->id)->latest()->first();
            $realAmount = isset($latestRemainingDrug) ? $latestRemainingDrug->amount : 0;
            $newMadel->medicine_id = $this->id;
            $newMadel->clinic_id = $data->clinic_id;
            $newMadel->amount = $realAmount + $data->amount;
            $newMadel->model_id = $data->id;
            $newMadel->type = Status::$import;
            return $newMadel->save();
        }else if
        ($type == Status::$returned){
            $latestRemainingDrug = RemainingDrug::where('medicine_id', $this->id)->latest()->first();
            $realAmount = isset($latestRemainingDrug) ? $latestRemainingDrug->amount : 0;
            if ($realAmount < $data->amount){
                return false;
            }
            $newMadel->medicine_id = $this->id;
            $newMadel->clinic_id = $data->clinic_id;
            $newMadel->amount = $realAmount - $data->amount;
            $newMadel->model_id = $data->id;
            $newMadel->type = Status::$returned;
            return $newMadel->save();
        }else if
        ($type == Status::$selling){
            $latestRemainingDrug = RemainingDrug::where('medicine_id', $this->id)->latest()->first();
            $realAmount = isset($latestRemainingDrug) ? $latestRemainingDrug->amount : 0;
            if ($realAmount < $data->amount){
                return false;
            }
            $newMadel->medicine_id = $this->id;
            $newMadel->clinic_id = $data->clinic_id;
            $newMadel->amount = $realAmount - $data->amount;
            $newMadel->model_id = $data->id;
            $newMadel->type = Status::$selling;
            return $newMadel->save();
        }else if
        ($type == Status::$invoiceReturned){
            $latestRemainingDrug = RemainingDrug::where('medicine_id', $this->id)->latest()->first();
            $realAmount = isset($latestRemainingDrug) ? $latestRemainingDrug->amount : 0;
            if ($realAmount < $data->amount){
                return false;
            }
            $newMadel->medicine_id = $this->id;
            $newMadel->clinic_id = $data->clinic_id;
            $newMadel->amount = $realAmount + $data->amount;
            $newMadel->model_id = $data->id;
            $newMadel->type = Status::$invoiceReturned;
            return $newMadel->save();
        }

    }


}
