<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AbstractController extends Controller
{
    /**
     * @var mixed
     */
    protected $service;
    /**
     *
     */
    public function __construct()
    {
        $this->service = new $this->service;
    }

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $items = $this->service->index();
        return $this->sendResponse($items);
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
    public function store()
    {

        $item = $this->service->store(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $item = $this->service->update(request()->all(), $id);
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function destroy($id)
    {
        $item = $this->service->destroy($id);

        return $this->sendResponse($item);
    }


    /**
     * @param $data
     * @return array|JsonResponse`
     */
    public function sendResponse($data)
    {
        return response()->json($data, 200);
    }

    public function uploadImages($model, $file)
    {

        if ($file->hasFile('images')) {
            $arxivImages = $model->images; // O'chirishni istagan faylning nomi
            if ($arxivImages != null) {
                foreach ($arxivImages as $arxivImage){
                    Storage::disk('public')->delete($arxivImage->url);
                }
                $model->images()->delete();
            }

            $images = $file->file('images');
            foreach ($images as $image){
                $path = $image->store('images', 'public'); // 'images' papkasi ichiga saqlaydi
                $newImage = new Image();
                $newImage->url = $path;
                $model->images()->save($newImage);

            }
        }
        return true;
    }
    public function uploadImagesOne($model, $file)
    {

        if ($file->hasFile('image')) {
            $arxivImages = $model->image; // O'chirishni istagan faylning nomi
            if ($arxivImages != null) {
                foreach ($arxivImages as $arxivImage){
                    Storage::disk('public')->delete($arxivImage->url);
                }
                $model->image()->delete();
            }

            $image = $file->file('image');
            $path = $image->store('images', 'public'); // 'images' papkasi ichiga saqlaydi
            $newImage = new Image();
            $newImage->url = $path;
            $model->image()->save($newImage);

        }
        return true;
    }
}
