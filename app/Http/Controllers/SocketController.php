<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Api\AbstractController;
use App\Models\Chat;
use App\Models\FakeUser;
use App\Models\Phrase;
use App\Models\User;
use App\Models\UserQuestionWord;
use App\Models\Word;
use App\Services\Api\ChatService;
use App\Services\Socket\SocketService;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketController extends GeneratedService implements MessageComponentInterface
{
    protected \SplObjectStorage $clients;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        echo "Socket started ...".PHP_EOL;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        $header = $this->getHeader($conn);
        $fakeUser = FakeUser::find($header['id']);

        // Foydaanuvchini saqlash
        if(!$fakeUser)$fakeUser = new FakeUser();
        $fakeUser->socket_id = $conn->resourceId;
        $fakeUser->save();

        // Foydalanuvchi uchun savol typega ega so'zlar saqlanmi yo'qmi tekshirish
        $userQuestionWords = UserQuestionWord::where('fake_user_id', $fakeUser->id)->get();
        if (count($userQuestionWords) == 0){
            $question = Phrase::where('type', Status::$question)->first();
            $questionWords = Word::where('phrase_id', $question->id)->get();
            foreach ($questionWords as $questionWord){
                $model = new UserQuestionWord();
                $model->fake_user_id = $fakeUser->id;
                $model->word_id = $questionWord->id;
                $model->save();
            }
        }

        $data = [
            'status' => true,
            'fakeUser' => $fakeUser
        ];

        $this->sendOne($fakeUser, 'connect', $data );

    }

    public function onMessage(ConnectionInterface $conn, $msg): void
    {
        $header = $this->getHeader($conn);
        $fakeUser = FakeUser::find($header['id']);
        $data = json_decode($msg, true);

        $this->userMessageSaved($fakeUser, $data);
        $result = $this->generateMessage($fakeUser, $data);

        if ($result['status']){
            $this->sendOne($fakeUser, 'message', $result);
        }else{
            $this->sendOne($fakeUser, 'error', $result['message']);
        }

        // Foydalanuvchiga savol berib bazani darak gaplar bilan toldirish
        $resultQuation = $this->generateQuationMessage($fakeUser, $data);
        if ($resultQuation['status']){
            $this->sendOne($fakeUser, 'message', $resultQuation);
        }

    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "An error has occurred: {$e->getMessage()} \n";
        $conn->close();
    }

    public function getHeader($conn)
    {
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);
        return $queryarray;
    }

    public function sendOne($fakeUser, $type , $data): void
    {
        foreach ($this->clients as $client) {
            if ($client->resourceId == $fakeUser->socket_id) {
                $client->send(json_encode([
                    'type' => $type,
                    'data' => $data
                ]));
            }
        }
    }

    public function userMessageSaved($user, $data): void
    {
        $userMessage = new Chat();
        $userMessage->user_id = $user->id;
        $userMessage->role = Status::$user;
        $userMessage->message = $data['message'];
        $userMessage->save();
    }


}




