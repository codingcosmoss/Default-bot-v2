<?php

namespace App\Http\Resources;

use App\Models\Notification;
use App\Models\RolePermission;
use App\Traits\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
                'url' => asset('').'Photos/user.png'
            ]
        ];

        $data = Notification::where('clinic_id', $this->clinic_id)
            ->where('type', Status::$change_role)
            ->where('model_id', $this->role_id)
            ->latest()
            ->first();


        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'email' => $this->email,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'role' => isset($this->role) ? $this->role->name : '',
            'role_token' => $data != null ? $data->token : '---',
            'position' => $this->position,
            'management' => $this->management,
            'permissions' => RolePermission::where('role_id', $this->role_id)->pluck('permission_name')->toArray()
        ];
    }
}
