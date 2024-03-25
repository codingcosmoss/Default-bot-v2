<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanySetting;
use App\Models\User;
use App\Services\Api\DiseasesService;
use App\Services\Api\EmployeesService;
use App\Services\Api\PatientService;
use App\Services\Api\SettingService;
use Illuminate\Http\Client\Request;

class SettingsController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = SettingService::class;

    public function companyShow()
    {
        $item = $this->service->companyShow(request()->all());
        return $this->sendResponse($item);
    }


    public function companyStore()
    {
        $item = $this->service->companyStore(request()->all());

        if ($item['status'] == true ){
            $this->uploadImagesOne(CompanySetting::find($item['data']['id']), request());
        }

        return $this->sendResponse($item);
    }


}
