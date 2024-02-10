<?php

namespace App\Services\Api;

use App\Models\Image;
use App\Traits\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AbstractService
{
    protected $model;

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model::all();
    }

    /**
     * @return mixed
     */
    public function orderBy($column = 'id', $type = 'desc')
    {
        return $this->model::orderBy($column, $type)->first();
    }


    /**
     * @return mixed
     */
    public function activeIndex()
    {
        return $this->model::where('status', Status::$status_active)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $data
     * @return JsonResponse|mixed
     */
    public function store(array $data)
    {
        $fields = $this->getFields();
        $rules = [];
        foreach ($fields as $field) {
            $rules[$field->getName()] = $field->getRules();
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();
        $object = new $this->model;
        foreach ($fields as $field) {
            $field->fill($object, $data);
        }
        $object->save();
        return $object;
    }


    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {

        $item = $this->show($id);

        $fields = $this->getFields();

        $rules = [];
        foreach ($fields as $field) {
            $rules[$field->getName()] = $field->getRules();
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $validator->validated();

        foreach ($fields as $field) {
            $field->fill($item, $data);
        }
        $item->save();
        return $item;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $item = $this->show($id);
        return $item->delete($id);
    }

    public function getFields()
    {
        return [];
    }

    /**
     * @param bool $status
     * @param string $message
     * @param int $statusCode
     * @param array|null $data
     * @return array
     */
    public function sendResponse(bool $status = true, string $message = 'success', int $statusCode = 200, $data = null)
    {
        return [
            'status' => $status,
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data
        ];
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
