<?php

namespace App\Models;

use App\Word\HtmlToDoc;
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

    public function downloadWord()
    {
        $htmlToDoc = new HtmlToDoc();
        $file = $this->getWordContent();
        return $htmlToDoc->createDoc($file, $this->patient->name . '_' . $this->patient->surname . ' №' . $this->daily_number . ' Sana: ' . $this->created_at, true);
    }

    public function getWordContent()
    {
        return view('anketa.main', ['model' => $this]);
    }



}

