<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\Api\AService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
    * Author: Muhammadali

    * Abstract Controller performs the task of unifying common functions in all controllers.
     All controllers inherit from this controller
**/

class AbstractController extends Controller
{
    protected $service;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = $this->service->index(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Get paginated data.
     *
     * @param int $count
     * @return JsonResponse
     */
    public function getPaginate($count)
    {
        $data = $this->service->getPaginate($count);
        return $this->sendResponse($data);
    }

    /**
     * Order the data by a specific column and type.
     *
     * @param string $column
     * @param string $type
     * @return JsonResponse
     */
    public function orderBy($column, $type)
    {
        $data = $this->service->orderBy($column, $type);
        return $this->sendResponse($data);
    }

    /**
     * Display a listing of active resources.
     *
     * @return JsonResponse
     */
    public function activeIndex()
    {
        $data = $this->service->activeIndex(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $data = $this->service->show($id);
        return $this->sendResponse($data);
    }

    /**
     * Store a newly created resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        $data = $this->service->store(request()->all());
        return $this->sendResponse($data);
    }

    /**
     * Update the specified resource.
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function update($id = null)
    {
        $data = $this->service->update(request()->all(), $id);
        return $this->sendResponse($data);
    }

    /**
     * Search for resources.
     *
     * @param string $search
     * @return JsonResponse
     */
    public function search($search)
    {
        $data = $this->service->search($search);
        return $this->sendResponse($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $data = $this->service->destroy($id);
        return $this->sendResponse($data);
    }

    /**
     * Send a JSON response with a 200 status code.
     *
     * @param $data
     * @return JsonResponse
     */
    public function sendResponse($data)
    {
        return response()->json($data, 200);
    }

    /**
     * Upload multiple images and associate them with the given model.
     *
     * @param $model
     * @param $file
     * @return bool
     */
    public function uploadImages($model, $file)
    {
        if ($file->hasFile('images')) {
            $oldImages = $model->images; // Get the existing images to be deleted
            if ($oldImages != null) {
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage->url);
                }
                $model->images()->delete();
            }

            $images = $file->file('images');
            foreach ($images as $image) {
                $path = $image->store('images', 'public'); // Store the image in the 'images' directory
                $newImage = new Image();
                $newImage->url = $path;
                $model->images()->save($newImage);
            }
        }
        return true;
    }

    /**
     * Upload a single image and associate it with the given model.
     *
     * @param $model
     * @param $file
     * @return bool
     */
    public function uploadImagesOne($model, $file)
    {
        if ($file->hasFile('image')) {
            $oldImage = $model->image; // Get the existing image to be deleted
            if ($oldImage != null) {
                Storage::disk('public')->delete($oldImage->url);
                $model->image()->delete();
            }

            $image = $file->file('image');
            $path = $image->store('images', 'public'); // Store the image in the 'images' directory
            $newImage = new Image();
            $newImage->url = $path;
            $model->image()->save($newImage);
        }
        return true;
    }
}

