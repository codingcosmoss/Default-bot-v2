<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\GroupResource;
use App\Models\User;
use App\Services\Api\FilialService;
use App\Services\Api\GroupService;
use App\Services\Api\WarehouseCategoryService;

class GroupController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = GroupService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

        return $this->sendResponse($item);
    }

    public function indexAll()
    {
        $item = $this->service->indexAll(request()->all());

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

}
