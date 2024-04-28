<?php

namespace App\Http\Controllers\Api;

use App\Models\Chatgpt;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use App\Services\Api\BrandService;
use App\Services\Api\FilialService;
use App\Services\Api\OpenAiService;
use App\Services\Api\ProductApiService;
use App\Services\Api\ProductService;
use App\Services\Api\WarehouseCategoryService;
use Illuminate\Support\Facades\Storage;

class OpenAiController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = OpenAiService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

        return $this->sendResponse($item);
    }

    public function send()
    {
        $item = $this->service->send(request()->all());

        return $this->sendResponse($item);
    }

    public function store()
    {
        $item = $this->service->store(request()->all());

        if ($item['status'] == true ){
            $this->uploadAudioOne(Chatgpt::find($item['data']['id']), request());
        }


        return $this->sendResponse($item);
    }

    public function uploadAudioOne($model, $file)
    {

        if ($file->hasFile('audio')) {
            $arxivImages = $model->image; // O'chirishni istagan faylning nomi
            if ($arxivImages != null) {
                foreach ($arxivImages as $arxivImage){
                    Storage::disk('public')->delete($arxivImage->url);
                }
                $model->image()->delete();
            }

            $image = $file->file('audio');
            $path = $image->store('images', 'public'); // 'images' papkasi ichiga saqlaydi
            $newImage = new Image();
            $newImage->url = $path;
            $model->image()->save($newImage);

        }
        return true;
    }




}
