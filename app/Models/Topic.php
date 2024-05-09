<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function words()
    {
        return $this->belongsToMany(Word::class, 'word_topics', 'word_id', 'topic_id');
    }
}
