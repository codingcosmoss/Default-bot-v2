<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultImage = [
            [
                'url' => asset('').'Audios/test.ogg'
            ]
        ];

        return [
            'id' => $this->id,
            'answer' => $this->answers,
            'audio' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,

        ];
    }
}
