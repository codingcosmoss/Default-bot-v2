<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Setting;
use App\Models\UserPermission;
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
                'url' => asset('').'Photos/user.png'
            ]
        ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage,
            'email' => $this->email,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'role' => isset($this->role) ? $this->role->name : '',
            'position' => $this->position,
            'payable' => $this->payable,
            'due' => $this->due,
            'private' => $this->private,
            'management' => $this->management,
            'permissions' => RolePermission::where('role_id', $this->role_id)->pluck('permission_name')->toArray()

        ];

    }
}
