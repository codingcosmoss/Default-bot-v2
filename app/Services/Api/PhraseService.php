<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\BrandResource;
use App\Http\Resources\PhraseResource;
use App\Models\Brand;
use App\Models\Phrase;

class PhraseService extends AbstractService
{
    protected $model = Phrase::class;
    protected $resource = PhraseResource::class;

    public function index()
    {
        $models = $this->model::all();
        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $this->resource::collection($models)
        ];
    }

}
