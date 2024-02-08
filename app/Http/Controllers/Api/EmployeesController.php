<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\EmployeesService;

class EmployeesController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = EmployeesService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

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
