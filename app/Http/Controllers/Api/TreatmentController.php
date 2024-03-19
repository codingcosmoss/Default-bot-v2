<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\Api\EmployeesService;
use App\Services\Api\PatientService;
use App\Services\Api\TreatmentService;
use Illuminate\Http\Client\Request;

class TreatmentController extends AbstractController
{
    /**
     * @var string
     */

    protected $service = TreatmentService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

        return $this->sendResponse($item);
    }

    public function treatmentAddServiceAll($id)
    {
        $item = $this->service->treatmentAddServiceAll($id);

        return $this->sendResponse($item);
    }
    public function treatmentFinished($id)
    {
        $item = $this->service->treatmentFinished($id);

        return $this->sendResponse($item);
    }
    public function treatmentSavedService()
    {
        $item = $this->service->treatmentSavedService(request()->all());

        return $this->sendResponse($item);
    }

    public function discount()
    {
        $item = $this->service->discount(request()->all());

        return $this->sendResponse($item);
    }

    public function treatmentAddService()
    {
        $item = $this->service->treatmentAddService(request()->all());

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

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {

        $item = $this->service->update(request()->all(), $id);
        if ($item['status'] == true ){
            $this->uploadImagesOne(User::find($item['data']['id']), request());
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
