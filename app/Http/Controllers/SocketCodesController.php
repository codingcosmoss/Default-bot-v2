<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompetitionResource;
use App\Models\Chat;
use App\Models\ChatRequest;
use App\Models\Competition;
use App\Models\Competition_sententenses;
use App\Models\CompetitionBall;
use App\Models\CompetitionQuation;
use App\Models\CompetitionResult;
use App\Models\Connection;
use App\Models\Result;
use App\Models\SentenceData;
use App\Models\Sentences;
use App\Models\User;
use App\Models\UserQuation;
use App\Models\Word;
use App\Models\WordData;
use Carbon\Carbon;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use function App\Http\Resources\shuffleArray;

class SocketCodesController implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        echo "Socket started ...".PHP_EOL;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);

        if (isset($queryarray['token'])){
            $token = PersonalAccessToken::findToken($queryarray['token']);
            $userInfo = $token->tokenable;
        }

        // foydalanuvchini faol qilish
        $this->userActive($userInfo, $conn);

    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $this->clients->attach($conn);

        // token va user malumotlarini olish
        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);

        $token = PersonalAccessToken::findToken($queryarray['token']);
        $userInfo = $token->tokenable;



        if ($msg === 'ping') {


            foreach ($this->clients as $client) {
                if ($client->resourceId == $conn->resourceId ) {
                    $client->send(json_encode([
                        'key' => 'pong',
                    ]));
                }
            }


        }else{
            date_default_timezone_set('Asia/Tashkent');
            $currentDateTime = date('Y-m-d H:i:s');

            $data = json_decode($msg, true);


            // O'yinni boshlash uchun sorov yuborish qismi

            if ($data['type'] == 'invite'){

                $userResult = CompetitionResult::where(function ($query) use ($userInfo) {
                    $query->where('user1_id', $userInfo->id)
                        ->orWhere('user2_id', $userInfo->id);
                })
                    ->where('is_finished', 0)
                    ->get();

                $userId = '';
                $failUser = [];
                if (count($userResult) > 0){

                    foreach ($userResult as $result) {
                        $userId = $result->user1_id == $userInfo->id ? $result->user2_id :  $result->user1_id;
                        $userResurseId = Connection::where('user_id' , $userId)
                            ->where('status', 1)
                            ->latest()
                            ->first();
                        array_push($failUser, $userResurseId->connection_id);

                        $data2 = [
                            'user_id' => $userId,
                            'result_id' => $result->id,
                            'resource_id' => $userResurseId->connection_id
                        ];

                        $this->stopGame($result, $userInfo, $data2, $conn);

                    }
                }



                $invite = [
                    'user_id' => $userInfo->id,
                    'user_name' => $userInfo->first_name.' '.$userInfo->last_name,
                    'resource_id' => $conn->resourceId,
                    'image' => asset('').'storage/'.$userInfo->image,
                    'type' => 'invite'
                ];


                $connections = Connection::where('user_id', '!=', $userInfo->id)
                    ->where('status', 1)
                    ->where('competition', 1)
                    ->select('connection_id')
                    ->get();

                $connectionArr = [];
                if (count($connections) != 0){
                    foreach ($connections as $key){
                        $connectionArr[] = $key->connection_id;
                    }
                }



                $connectionArr = array_merge($connectionArr, $failUser);
                print_r(array_values($connectionArr));
                foreach ($this->clients as $client) {
                    // o'ynayotgan userlardan tashqari hammaga jonatish
                    if ($client->resourceId !== $conn->resourceId && !in_array($client->resourceId, $connectionArr )) {
                        $client->send(json_encode($invite));
                    }
                    if ($client->resourceId == $conn->resourceId ) {
                        $client->send(json_encode($this->respons(200, 'invite', 'Raqib qidirilmoqda...')));
                    }
                }

            }

            // Taklifni qabul qilish

            if ($data['type'] == 'join'){

                $userConn = Connection::where('user_id', $data['user_id'])
                    ->where('status', 1)
                    ->where('competition', 0)
                    ->first();

                // O'yinni boshlash uchun malumotlar generatsiya qilish

               if ($userConn){

                   $result = $this->cretaResult($userInfo, $data);
                   $quations = $this->parseQuations($result);
                   $user = User::find($data['user_id']);
                   $user2 = User::find($data['user_id']);


                   $join = [
                       'user_rival' => [
                           'id' => $userInfo->id,
                           'name' => $userInfo->first_name.' '.$userInfo->last_name,
                           'image' => asset('').'storage/'.$userInfo->image,
                           'resource_id' =>  $conn->resourceId


                       ],
                       'user' => [
                           'id' => $data['user_id'],
                           'name' => $user2->first_name.' '.$user2->last_name,
                           'image' => asset('').'storage/'.$user2->image,

                       ],
                       'result_id' => $result->id,
                       'type' => 'playing',
                       'quations' => $quations,
                   ];


                   $join2 = [
                       'user_rival' => [
                           'id' => $data['user_id'],
                           'name' => $user2->first_name.' '.$user2->last_name,
                           'image' => asset('').'storage/'.$user2->image,
                           'resource_id' => $data['resource_id'],

                       ],
                       'user' => [
                           'id' => $userInfo->id,
                           'name' => $userInfo->first_name.' '.$userInfo->last_name,
                           'image' => asset('').'storage/'.$userInfo->image,

                       ],
                       'result_id' => $result->id,
                       'type' => 'playing',
                       'quations' =>  $quations,
                   ];

                   foreach ($this->clients as $client) {
                       if ($client->resourceId == $data['resource_id'] ) {
                           $client->send(json_encode($join));
                       }elseif($client->resourceId == $conn->resourceId){
                           $client->send(json_encode($join2));
                           $client->send(json_encode($this->respons(200, 'join', 'Musobaqa boshlandi...')));
                       }
                   }
               }else{
                   foreach ($this->clients as $client) {
                       if ($client->resourceId == $conn->resourceId ) {
                           $client->send(json_encode([
                               'type' => 'error',
                               'message' => 'The competition has started'
                           ]));
                       }
                   }
               }


            }

            // javob berish
            if ($data['type'] == 'answer'){

                $result = CompetitionResult::find($data['result_id']);
                $resutTime = strtotime($result->finished_at);

                // vaqatni tekshirish
                if ( $resutTime < time() ){

                    $this->finish($result, $userInfo, $data, $conn);

                }else{
                    // davom etish
                    $typeStr = '';
                    $next = false;

                    $answer = CompetitionBall::where('result_id', $data['result_id'])
                        ->where('quation_id', $data['quation_id'])
                        ->where('user_id', $data['user_id'])
                        ->first();

                    if ($answer){
                        if ($answer->status == 0){
                            $userBall = new CompetitionBall();
                            $userBall->user_id = $userInfo->id;
                            $userBall->result_id = $data['result_id'];
                            $userBall->quation_id = intval($data['quation_id']);
                            $userBall->status = intval($data['answer']);
                            $userBall->quantity = 1;
                            $userBall->save();
                            $typeStr = 'next';
                            $next = true;
                        }

                    }else{
                        $userBall = new CompetitionBall();
                        $userBall->user_id = $userInfo->id;
                        $userBall->result_id = $data['result_id'];
                        $userBall->quation_id = intval($data['quation_id']);
                        $userBall->status = intval($data['answer']);
                        $userBall->quantity = 1;
                        $userBall->save();
                        $typeStr = $data['answer'] == 1 ? 'next' : 'stop';
                    }

                    $userBalls = CompetitionBall::where('user_id', $userInfo->id)
                            ->where('result_id', $data['result_id'])
                            ->where('status', 1)
                            ->get();

                    $message = [
                        'type' => $typeStr,
                        'royal_ball' => count($userBalls) * 5,
                        'answer' => $data['answer']
                    ];

                    if ($next == true && $typeStr != ''){
                        foreach ($this->clients as $client) {
                            if ($client->resourceId == $data['resource_id'] ) {
                                $client->send(json_encode($message));
                            }

                            if ($client->resourceId == $conn->resourceId){
                                $userBalls2 = CompetitionBall::where('user_id', $data['user_id'])
                                    ->where('result_id', $data['result_id'])
                                    ->where('status', 1)
                                    ->get();

                                $client->send(json_encode($this->respons(200, 'answer', 'Javob berildi...')));

                                $client->send(json_encode([
                                    'type' => $typeStr,
                                    'royal_ball' => count($userBalls2) * 5,
                                    'answer' => $answer->status
                                ]));
                            }
                        }
                    }else if ($typeStr != ''){
                        foreach ($this->clients as $client) {
                            if ($client->resourceId == $data['resource_id'] ) {
                                $client->send(json_encode($message));
                            }

                            if ($client->resourceId == $conn->resourceId ) {
                                $client->send(json_encode($message));
                            }

                        }

                    }


                }


            }

            if($data['type'] == 'finish'){
                $result = CompetitionResult::find($data['result_id']);
                $this->finish($result, $userInfo, $data, $conn);
            }
        }





    }

    public function respons($code, $type, $message = null){
        $succses = [
            'status' => $code,
            'type' => $type,
            'message' => $message,
        ];
        return $succses;
    }


    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        $querystring = $conn->httpRequest->getUri()->getQuery();

        parse_str($querystring, $queryarray);





        if(isset($queryarray['token']))
        {
            $token = PersonalAccessToken::findToken($queryarray['token']);
            $userInfo = $token->tokenable;

            // o'yinlarni bekor iqlish

            $userResult = CompetitionResult::where(function ($query) use ($userInfo) {
                $query->where('user1_id', $userInfo->id)
                    ->orWhere('user2_id', $userInfo->id);
            })
                ->where('is_finished', 0)
                ->get();

            $userId = '';
            if (count($userResult) > 0){

                foreach ($userResult as $result) {
                    $userId = $result->user1_id == $userInfo->id ? $result->user2_id :  $result->user1_id;
                    $userResurseId = Connection::where('user_id' , $userId)
                        ->where('status', 1)
                        ->latest()
                        ->first();

                    $data2 = [
                        'user_id' => $userId,
                        'result_id' => $result->id,
                        'resource_id' => $userResurseId->connection_id
                    ];

                    $this->stopGame($result, $userInfo, $data2, $conn);

                }
            }

            $connnection = Connection::where('user_id', $userInfo->id)
                ->where('status', true)
                ->first();

            if ($connnection) {
                $connnection->status = false;
                $connnection->save();
            }

        }


    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} \n";




            foreach ($this->clients as $client) {
                if ($client->resourceId == $conn->resourceId ) {
                    $client->send(json_encode($this->respons(200, 'error', $e->getMessage())));
                }
            }

        $conn->close();
    }



    // O'yin logikasi

    public function userActive($userInfo, $conn){

        $connnection = Connection::where('user_id', $userInfo->id)
        ->where('status', true)
        ->first();

        $userBall = User::find($userInfo->id)->userBalls()
            ->where('answer', true)
            ->sum('quantity');

        if (!$connnection) {
            $connnection = new Connection();
            $connnection->user_id = $userInfo->id;
            $connnection->last_name = $userInfo->last_name;
            $connnection->first_name = $userInfo->first_name;
            $connnection->user_ball = round($userBall);
            $connnection->degree_id = $userInfo->user_degree_id;
            $connnection->image = $userInfo->image;
            $connnection->connection_id = $conn->resourceId;
            $connnection->status = true;
            $connnection->save();
        }else{
            $connnection->last_name = $userInfo->last_name;
            $connnection->first_name = $userInfo->first_name;
            $connnection->user_ball = round($userBall);
            $connnection->degree_id = $userInfo->user_degree_id;
            $connnection->image = $userInfo->image;
            $connnection->connection_id = $conn->resourceId;
            $connnection->status = true;
            $connnection->competition = 0;
            $connnection->save();
        }



//        $userCon = Connection::where('status', true)
//                ->select('user_id', 'last_name', 'first_name', 'user_ball', 'degree_id', 'image')
//                ->get();
//
//
//        foreach($this->clients as $client)
//        {
//            $client->send(json_encode($userCon->toArray()));
//        }

    }

    public  function  generateQuestions(){

    }

    private function parseQuations($result)
    {

        $arr = [];
        $arr1 = [];
        $arr2 = [];
        $null = false;
        $a = 0;

        $quations = CompetitionQuation::where('competition_result_id', $result->id)
            ->get();

        foreach ($quations as $quation) {



            if ($null != true ) {

                $varyand = [];
                $options = UserQuation::find($quation->varyand)->userOptions;

                foreach ($options as $option) {
                    array_push($varyand, [
                        'id' => $option->id,
                        'word_name' => $option->word->name_uz,
                        'is_answer' => intval($option->is_answer),
                    ]);
                }

//                $video = WordData::where('word_id', $quation->word_id)->where('data_type', 'movie')->get()->first();
                $image = WordData::where('word_id', $quation->word_id)->where('data_type', 'image')->get()->first();


                array_push($arr2, [
                    'id' => $quation->id,
                    'name_en' => $quation->name_en,
                    'name_uz' => $quation->name_uz,
//                    'video' => $video ?  asset('').'/'.$video->url : Null,
                    'image' => $image ?  asset('').'/'.$image->url : Null,
                    'time' => 5,
                    'varyands' => $varyand,
//                    'type' => 3,
                ]);
            }
        }



        return  $arr2;
    }

    public function cretaResult($user, $data){
        $created = false;


        // Eski resultni yakunlash
        $this->appointedResult($user);

        $ball = User::find($user->id)->userBalls()
            ->where('answer', true)
            ->sum('quantity');

        // Competitions bor bolishi kerak


        $competitionResult = CompetitionResult::where('user2_id', $user->id)
            ->where('is_finished', false)
            ->where('started_at','!=', null)
            ->first();

        if ($competitionResult) {
            return $competitionResult;
        }



        if (!$competitionResult){
            $competitionResult = new CompetitionResult();
            $competitionResult->user1_id = $user->id;
            $competitionResult->save();
            $created = true;
        }
        // end

        // result tekshiruvchi

        // Boshlash uchun resulni toldirish
        if ($created == true) {
            $userId = $data['user_id'];
        }else{
            $userId = $user->id;
        }


        $startTime = strtotime('+5 minutes');
        $competitionResult->user2_id = $userId;
        $competitionResult->started_at =  date('Y-m-d H:i:s');
        $competitionResult->finished_at = date('Y-m-d H:i:s', $startTime);
        // $competitionResult->quations =  json_encode($this->quations($competitionResult));
        $competitionResult->is_finished = false;
        $competitionResult->save();

        $connection1 = Connection::where('user_id', $userId)->where('status', 1)->update(['competition' => 1]);
        $connection2 = Connection::where('user_id', $user->id)->where('status', 1)->update(['competition' => 1]);

        $this->quations($competitionResult);
        return $competitionResult; // bu xolat albatta true qaytishi kerak


    }

    public function appointedResult($user){

        $competitionResult = CompetitionResult::where('user1_id', $user->id)
            ->where('is_finished', false)
            ->first();

        if ($competitionResult) {
            $competitionResult->is_finished = true;
            $competitionResult->save();
        }

        return $competitionResult ? $competitionResult : Null;
    }

    public function quations($result){
        // $quation = ['sentences' => [], 'quations' => []];

        $sentences = Sentences::inRandomOrder()->limit(14)->get()->all();
        // Savollar limiti
        $quations = UserQuation::inRandomOrder()->limit(6)->get()->all();

        //create sentences
        foreach($sentences as $sentence){
            $comsentence = new Competition_sententenses();
            $comsentence->competition_result_id = $result->id;
            $comsentence->name_uz = $sentence->name_uz;
            $comsentence->name_en = $sentence->name_en;
            $comsentence->sentence_id = $sentence->id;
            $comsentence->save();
        }

        //create quations
        foreach($quations as $quation){
            $word = Word::find($quation->word_id);
            $comquation = new CompetitionQuation();
            $comquation->competition_result_id = $result->id; // competition_result_id ni set qilish kerak
            $comquation->name_uz = $word->name_uz;
            $comquation->name_en = $word->name_en;
            $comquation->word_id = $word->id;
            $comquation->varyand = $quation->id;
            $comquation->save();
        }

        // array_push($quation['sentences'], $sentences);
        // array_push($quation['quations'], $quations);

        return null;
    }

    public  function finish($result, $userInfo, $data, $conn){

        $user1 = CompetitionBall::where('result_id' , $result->id)
            ->where('user_id', $userInfo->id)
            ->where('status', 1)
            ->get();

        $user2 = CompetitionBall::where('result_id' , $result->id)
            ->where('user_id', $data['user_id'])
            ->where('status', 1)
            ->get();

        $victoryId = '';
        if ( count($user1) > count($user2)){
            $victoryId = $userInfo->id;
        }elseif ( count($user1) < count($user2)){
            $victoryId = $data['user_id'];
        }else{
            $victoryId = 0;
        }

        $result->is_finished = 1;
        $result->victory = $victoryId;
        $result->save();

        $messageUser1 = [
            'type' => 'finish',
            'user_royal' => [
                'victory' => $victoryId == $userInfo->id ? 1 : 0,
                'correct_answers' => count($user1),
                'wrong answers' => 6 - count($user1),
                'ball' => count($user1) * 5
            ],
            'user' => [
                'victory' => $victoryId == $data['user_id'] ? 1 : 0,
                'correct_answers' => count($user2),
                'wrong_answers' => 6 - count($user2),
                'ball' => count($user2) * 5
            ]
        ];

        $messageUser2 = [
            'type' => 'finish',
            'user_royal' => [
                'victory' => $victoryId == $data['user_id'] ? 1 : 0,
                'correct_answers' => count($user2),
                'wrong_answers' => 6 - count($user2),
                'ball' => count($user2) * 5
            ],

            'user' => [
                'victory' => $victoryId == $userInfo->id ? 1 : 0,
                'correct_answers' => count($user1),
                'wrong_answers' => 6 - count($user1),
                'ball' => count($user1) * 5
            ],

        ];

        // Ularni bekorchi qilib q0yish
        $connection1 = Connection::where('user_id', $userInfo->id)->where('status', 1)->update(['competition' => 0]);
        $connection2 = Connection::where('user_id', $data['user_id'])->where('status', 1)->update(['competition' => 0]);

        $succses = [
            'status' => 200,
            'success' => true
        ];

        foreach ($this->clients as $client) {
            if ($client->resourceId == $data['resource_id'] ) {
                $client->send(json_encode($messageUser1));
            }
            if ($client->resourceId == $conn->resourceId) {
                $client->send(json_encode($this->respons(200, 'finish', 'O\'yin yakunlandi...')));
                $client->send(json_encode($messageUser2));

            }
        }
    }

    public  function stopGame($result, $userInfo, $data, $conn){

        $user1 = CompetitionBall::where('result_id' , $result->id)
            ->where('user_id', $data['user_id'])
            ->where('status', 1)
            ->get();

        $connection1 = Connection::where('user_id', $userInfo->id)->where('status', 1)->update(['competition' => 0]);
        $connection2 = Connection::where('user_id', $data['user_id'])->where('status', 1)->update(['competition' => 0]);

        $result->is_finished = 1;
        $result->victory = $data['user_id'];
        $result->save();

        $messageUser2 = [
            'type' => 'finish',
            'user_royal' => [
                'victory' => 0,
                'correct_answers' => 0,
                'wrong_answers' => 0,
                'ball' => 0
            ],

            'user' => [
                'victory' => 1,
                'correct_answers' => count($user1),
                'wrong_answers' => 6 - count($user1),
                'ball' => count($user1) * 5
            ],

        ];

        $succses = [
            'status' => 200,
            'success' => true
        ];

        foreach ($this->clients as $client) {
            if ($client->resourceId == $data['resource_id']) {
                $client->send(json_encode($messageUser2));
            }

            if ($client->resourceId == $conn->resourceId) {
                $client->send(json_encode($messageUser2));
                $client->send(json_encode($succses));

            }


        }

    }
}




