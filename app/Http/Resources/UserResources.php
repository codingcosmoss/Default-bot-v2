<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
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
                'url' => 'https://www.pinclipart.com/picdir/big/164-1647836_album-collection-list-music-playlist-songs-icon-gallery.png'
            ]
        ];
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'position' => $this->position,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'color' => $this->color,
            'status' => $this->status,
            'percent_salary' => $this->percent_salary,
            'salary_static' => $this->salary_static,
            'sort_order' => $this->sort_order,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
        ];

    }
}
