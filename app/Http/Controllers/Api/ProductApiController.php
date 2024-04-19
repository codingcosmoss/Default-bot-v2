<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\User;
use App\Services\Api\FilialService;
use App\Services\Api\ProductApiService;
use App\Services\Api\ProductService;
use App\Services\Api\WarehouseCategoryService;

class ProductApiController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = ProductApiService::class;

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
        if ($item['status'] == true ){
            $this->uploadImagesOne(Product::find($item['data']['id']), request());
        }

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
