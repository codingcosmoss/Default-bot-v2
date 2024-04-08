<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Models\User;
use App\Services\Api\EmployeesService;
use App\Services\Api\PatientService;
use Illuminate\Http\Client\Request;

class PatientController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = PatientService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

        return $this->sendResponse($item);
    }
    public function updatePassword()
    {
        $item = $this->service->updatePassword(request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function show($id)
    {
        $item = $this->service->show($id);

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->service->store(request()->all());

        if ($item['status'] == true ){
            $this->uploadImagesOne(Patient::find($item['data']['id']), request());
        }

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {

        $item = $this->service->update(request()->all(), $id);
        if ($item['status'] == true ){
            $this->uploadImagesOne(Patient::find($item['data']['id']), request());
        }
        return $this->sendResponse($item);
    }
    public function joinDr()
    {
        $item = $this->service->joinDr(request()->all());
        return $this->sendResponse($item);
    }


    /**
     * @return array|JsonResponse
     */
    public function checkSortOrder()
    {
        $item = $this->service->checkSortOrder();

        return $this->sendResponse($item);
    }
    public function delete($id)
    {
        $item = $this->service->destroy($id);

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $item = $this->service->search(request()->all());

        return $this->sendResponse($item);
    }

    public function testLogin()
    {
        $item = $this->service->testLogin(request()->all());

        return $this->sendResponse($item);
    }
}
