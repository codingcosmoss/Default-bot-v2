<?php

namespace App\Http\Resources;

use App\Models\WordTopic;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'name' => $this->name,
            'words' => WordTopic::where('topic_id', $this->id)->count()
        ];
    }
}
