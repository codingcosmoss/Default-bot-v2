<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\GroupResource;
use App\Models\User;
use App\Services\Api\CollectionService;
use App\Services\Api\FilialService;
use App\Services\Api\GroupService;
use App\Services\Api\ProductDocumentService;
use App\Services\Api\WarehouseCategoryService;

class ProductDocumentController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = ProductDocumentService::class;

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
     * @param $id
     * @return array|JsonResponse
     */
    public function importedProducts()
    {
        $item = $this->service->importedProducts(request()->all());
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

    public function getProducts($id)
    {
        $item = $this->service->getProducts($id);

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
