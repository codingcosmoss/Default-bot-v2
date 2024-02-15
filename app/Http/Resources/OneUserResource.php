<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OneUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultImage = 'https://www.pinclipart.com/picdir/big/164-1647836_album-collection-list-music-playlist-songs-icon-gallery.png';
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'position' => $this->position,
            'color' => $this->color,
            'status' => $this->status,
            'percent_salary' => $this->percent_salary,
            'salary_static' => $this->salary_static,
            'sort_order' => $this->sort_order,
            'email' => $this->email,
            'image' => $this->url != null ?  asset("").'storage/'.$this->url : $defaultImage
        ];
    }
}
