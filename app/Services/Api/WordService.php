<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\WordResource;
use App\Models\FakeUser;
use App\Models\Phrase;
use App\Models\SavedWord;
use App\Models\Source;
use App\Models\User;
use App\Models\UserQuestionWord;
use App\Models\Word;
use App\Models\WordTopic;
use App\Traits\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WordService extends AbstractService
{
    protected $model = Word::class;
    protected $resource = WordResource::class;

    public function index($data = array())
    {
        $models = $this->model::orderBy('updated_at', 'desc')
            ->paginate($data['count']);

        $data = [
            'items' => $this->resource::collection($models),
            'pagination' => [
                'total' => $models->total(),
                'per_page' => $models->perPage(),
                'current_page' => $models->currentPage(),
                'last_page' => $models->lastPage(),
                'from' => $models->firstItem(),
                'to' => $models->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            TextField::make('text')->setRules('required|string'),
            TextField::make('phrase_id')->setRules('required|integer'),
            TextField::make('word_topics')->setRules('required|array'),
            TextField::make('save_word_id')->setRules('nullable'),
            TextField::make('source_id')->setRules('nullable'),
        ];
    }

    public function getUpdateFields()
    {
        return [
            TextField::make('text')->setRules('required|string'),
            TextField::make('phrase_id')->setRules('required|integer'),
            TextField::make('word_topics')->setRules('required|array'),
        ];
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
            $source_id = null;
            if (isset($data['source_id'])){
                $source_id = $data['source_id'];
            }else{
                $source = Source::where('name', 'Manual')->first();
                if (!$source){
                    $source = new Source();
                    $source = 'Manual';
                    $source =  "Qo'lda kiritilgan so'zlar";
                    $source->save();
                }
                $source_id = $source->id;
            }

            $model = new $this->model;
            $model->text = $data['text'];
            $model->phrase_id = $data['phrase_id'];
            $model->source_id = $source_id;



            if ($model->save()) {
                DB::commit();

                $phrase = Phrase::find($data['phrase_id']);
                if ($phrase){
                    if ($phrase->type == Status::$question){
                        $fakeUsers = FakeUser::all();
                        foreach ($fakeUsers as $fakeUser){
                            $userQuestion = new UserQuestionWord();
                            $userQuestion->fake_user_id = $fakeUser->id;
                            $userQuestion->word_id = $model->id;
                            $userQuestion->save();
                        }
                    }
                }

                if (isset($data['save_word_id'])){
                    $saveWord = SavedWord::find($data['save_word_id']);
                    if ($saveWord){
                        $saveWord->status = 0;
                        $saveWord->save();
                    }
                }
                foreach($data['word_topics'] as $topic){
                    $wordTopic = new WordTopic();
                    $wordTopic->word_id = $model->id;
                    $wordTopic->topic_id = $topic['id'];
                    $wordTopic->percent = $topic['percent'];
                    $wordTopic->save();
                }

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



    //<editor-fold desc="Edit">
    /**
     * @param array $data
     * @param $id
     * @return JsonResponse|mixed
     */
    public function update(array $data, $id)
    {
        $model = $this->model::find($id);

        if (!$model) {
            return [
                'status' => false,
                'message' => "User deleted ",
                'statusCode' => 404,
                'data' => null
            ];
        }

        $fields = $this->getUpdateFields();

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
                'statusCode' => 403,
                'data' => $errors
            ];
        }
        DB::beginTransaction();
        try {
            if (!(isset($data['word_topics']) && count($data['word_topics'])>0) ){
                return [
                    'status' => false,
                    'message' => 'Validation error',
                    'statusCode' => 401,
                    'data' => ['word_topics' => "Word topics required "]
                ];
            }

            $model->text = $data['text'];
            $model->phrase_id = $data['phrase_id'];

            if ($model->save()) {
                DB::commit();
                $deleteModels = WordTopic::where('word_id', $model->id)->delete();
                foreach($data['word_topics'] as $topic){
                    $wordTopic = new WordTopic();
                    $wordTopic->word_id = $model->id;
                    $wordTopic->topic_id = $topic['topic_id'];
                    $wordTopic->percent = $topic['percent'];
                    $wordTopic->save();
                }
            } else {
                DB::rollback();
                return [
                    'status' => false,
                    'message' => 'save user error',
                    'statusCode' => 500,
                    'data' => null
                ];
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'Server error',
                'statusCode' => 500,
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


    /**
     * @param $id
     * @return UserResource|mixed
     */
    public function show($id)
    {
        $model = $this->model::find($id);

        if (!$model) {
            return [
                'status' => false,
                'message' => 'Staff not found',
                'statusCode' => 403,
                'data' => null
            ];
        }
        return [
            'status' => true,
            'message' => 'success',
            'statusCode' => 200,
            'data' => new $this->resource($model)
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model::find($id);
        $wordTopics = WordTopic::where('word_id', $id)->delete();
        if ($model) {
            if($model->delete()) {
                return [
                    'status' => true,
                    'message' => 'success',
                    'statusCode' => 200,
                    'data' => null
                ];
            }
        }
        return [
            'status' => false,
            'message' => 'There was a problem deleting',
            'statusCode' => 403,
            'data' => null
        ];
    }


    /**
     * @param array $data
     * @return array
     */
        public function search(array $data)
    {
        $key = $data['search'] ?? '';
        $column = $data['column'] ?? 'updated_at';
        $sort = $data['order'] ?? 'desc';

        $models = $this->model::where(function ($query) use ($key) {
            empty($key) ? $query : $query->where('text', 'like', '%' . $key . '%');
        })
            ->orderBy($column, $sort)
            ->paginate(10);

        $data = [
            'items' => $this->resource::collection($models),
            'pagination' => [
                'total' => $models->total(),
                'per_page' => $models->perPage(),
                'current_page' => $models->currentPage(),
                'last_page' => $models->lastPage(),
                'from' => $models->firstItem(),
                'to' => $models->lastItem(),
            ],
        ];

        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => $data
        ];
    }

}
