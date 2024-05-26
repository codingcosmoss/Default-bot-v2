<?php

namespace App\Http\Resources;

use App\Models\WordTopic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'phrase' => $this->phrase,
            'topics' => WordTopicResource::collection(WordTopic::where('word_id', $this->id)->get())
        ];
    }
}
