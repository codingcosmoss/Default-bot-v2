<?php

namespace App\Services\Api;

use App\Fields\Store\TextField;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\FakeUser;
use App\Traits\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChatService extends AbstractService
{
    protected $model = Chat::class;
    protected string $resource = ChatResource::class;

    public function getMessages($id = 0): array
    {
        $messages = $this->model::where('user_id', $id)
            ->orderBy('id', 'desc')
            ->take(100)
            ->get();


        return [
            'status' => true,
            'message' => 'Success',
            'statusCode' => 200,
            'data' => ChatResource::collection($messages)
        ];
    }

    public function generateMessage($user, $data)
    {
        DB::beginTransaction();
        $saved = true;


        $userMessage = new $this->model;
        $userMessage->user_id = $user->id;
        $userMessage->role = Status::$user;
        $userMessage->message = $data['message'];
        $userMessage->save() == false ? $saved = false : '';

        // ...
        $text = "Sizni yaxshi ko'raman 🥰";
        $botMessage = new $this->model;
        $botMessage->user_id = $user->id;
        $botMessage->role = Status::$bot;
        $botMessage->message = $text;
        $botMessage->save() == false ? $saved = false : '';

        if ($saved) {
            DB::commit();
            return [
                'status' => true,
                'user' => $data['message'],
                'bot' => $text,
            ];
        } else {
            DB::rollback();
            return [
                'status' => false,
                'message' => 'save user error',
                'statusCode' => 200,
                'data' => null
            ];
        }
    }



}
