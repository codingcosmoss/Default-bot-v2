<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\FilialResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TreatmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Brand;
use App\Models\Chatgpt;
use App\Models\Filial;
use App\Models\Image;
use App\Models\Product;
use App\Models\Treatment;
use App\Models\Warehouse;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OpenAiService extends AbstractService
{
    /**
     * @var string
     */
    protected $model = Chatgpt::class;

    public function index($data = null)
    {
        $models = $this->model::orderBy('updated_at', 'desc')
            ->get();

        $data = [
            'items' => $models,
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    public function getFields()
    {
        return [
            TextField::make('question')->setRules('required'),
            TextField::make('answers')->setRules('required'),
        ];
    }

    public function getSendFields()
    {
        return [
            TextField::make('question')->setRules('required'),
        ];
    }


    public function store(array $data)
    {
        $fields = $this->getFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 200,
                'data' => $errors
            ];
        }

        $data = $validator->validated();
        DB::beginTransaction();
        try {
            $model = new $this->model;
            $model->question = $data['question'];
            $model->answers = $data['answers'];

            if ($model->save()) {
                DB::commit();
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 200,
                    'data' => null
                ];
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 200,
                'data' => $ex->getMessage()
            ];
        }


        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => $model
        ];
    }

    public function send($data = null)
    {
        $fields = $this->getSendFields();

        $rules = [];

        foreach ($fields as $field) {

            $rules[$field->getName()] = $field->getRules();
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $errors = [];

            foreach ($validator->errors()->getMessages() as $key => $value) {

                $errors[$key] = $value[0];
            }

            return [
                'status' => false,
                'message' => 'Validation error',
                'statusCode' => 200,
                'data' => $errors
            ];
        }

        $data = $validator->validated();

        $question = $data['question'];

        // Logika
        if ($data['question'] == ''){
            return [
                'status' => true,
                'message' => 'Success',
                'statusCode' => 200,
                'data' => 'Menga biron savolingiz bormi ?'
            ];
        }

        $answer = $this->model::where(function ($query) use ($question) {
            empty($question) ? $query : $query->where('question', 'like', '%' . $question . '%');
        })->first();

        if (!$answer){
            return [
                'status' => true,
                'message' => 'Success',
                'statusCode' => 200,
                'data' => [
                    'id' => 0,
                    'answer' => 'Not fount',
                    'audio' => [
                        [
                            'url' => asset('').'Audios/test.ogg'
                        ]
                    ],
                ]
            ];
        }

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => new AnswerResource($answer)
        ];

    }






}
