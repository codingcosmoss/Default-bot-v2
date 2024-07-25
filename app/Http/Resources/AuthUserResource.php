<?php

namespace App\Http\Resources;

use App\Models\Notification;
use App\Models\RolePermission;
use App\Models\Setting;
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
            ],
        ];
        $defaultLogo = [
            [
                'url' => asset('').'Photos/company-logo.png'
            ],
        ];

        $data = Notification::where('clinic_id', $this->clinic_id)
            ->where('type', Status::$change_role)
            ->where('model_id', $this->role_id)
            ->latest()
            ->first();

        $setting = Setting::where('clinic_id', $this->clinic_id)->first();


        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'image' => count($this->image) != 0 ? ImageResource::collection($this->image) : $defaultImage ,
            'email' => $this->email,
            'clinic_id' => $this->clinic_id,
            'phone' => $this->phone,
            'role_id' => $this->role_id,
            'role' => isset($this->role) ? $this->role->name : '',
            'role_token' => $data != null ? $data->token : '---',
            'position' => $this->position,
            'management' => $this->management,
            'logo' => count($setting->image) != 0 ? ImageResource::collection($setting->image) : $defaultLogo ,
            'currency' => $setting->currency,
            'currency_id' => $setting->currency_id,
            'permissions' => RolePermission::where('role_id', $this->role_id)->pluck('permission_name')->toArray()
        ];
    }
}
