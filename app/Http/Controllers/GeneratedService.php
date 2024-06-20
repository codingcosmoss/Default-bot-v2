<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\OutputWord;
use App\Models\Phrase;
use App\Models\SavedWord;
use App\Models\Source;
use App\Models\Topic;
use App\Models\UserQuestionWord;
use App\Models\Word;
use App\Models\WordTopic;
use App\Traits\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Termwind\renderUsing;

class GeneratedService
{
    // so'roq so'zlar
    public array $questionWords = ["Kim", "Nima", "Qayerda", "Qachon", "Qanday", "Qancha", "Qaysi", "Qaysi biri", "Nega", "Kimning", "Nimaga", "Qayerga", "Qayerdan", "Kimdan", "Kimga"];

    public function generateMessage($user = [], $data)
    {
        $saved = true;

        // so'zni turini aniqlash
        $wordTypeResult = $this->searchWordType($user->id, $data['message']);

//        $phrase = Phrase::where('type', $wordTypeResult['type'])->first();


        // Agar so'z bazada mavjud bolsa so'z uchun chiqishlar qidiriladi
        if ($wordTypeResult['isWord']) {
            $outputResult = $this->outgoingWord($user->id, $wordTypeResult['word_id']);
            if ($outputResult['result']) {
                return [
                    [
                        'status' => true,
                        'comment' => "So'z turi va so'z uchun muvoffaqiyatli chiqish topildi",
                        'message' => $outputResult['text'],
                        'time' => Carbon::parse($outputResult['time'])->format('Y-m-d H:i'),
                    ]
                ];
            }
        }

        // so'zni izlash yoki yani so'z generatsiya qilish
        $generateWordResult = $this->generateWord($wordTypeResult['topics'], $data['message']);

        if (!$generateWordResult['result']){
            return [
                'status' => false,
                'message' => $generateWordResult['message']
            ];
        }

        $savedWord = $this->saveWord($user->id, $generateWordResult['text']);

        return [
            'status' => true,
            'comment' => "Yangi so'z genratsiya qilindi",
            'message' => $savedWord->message,
            'role' => Status::$bot,
            'time' => Carbon::parse($savedWord->created_at)->format('Y-m-d H:i'),
        ];

    }

    public function saveWord($user_id, $text)
    {
        $botMessage = new Chat();
        $botMessage->user_id = $user_id;
        $botMessage->role = Status::$bot;
        $botMessage->message = $text;
        $botMessage->save();
        return $botMessage;
    }

    // So'zni bazadan qidirish
    public function searchWordType($user_id, $word): bool|array
    {
//        if ($word == null) return false;
//        if (strlen($word) == 0) return false;


        // agar bundan avvalgi bot qaytargan so'z so'z so'roq gap bolsa darak gap sifatida hozrgi so'zni saqlash
       $isQuestion = $this->savedQuestionWord($user_id, $word);

        $isWord = Word::whereRaw('LOWER(`text`) = LOWER(?)', [$word])
            ->first();

        // So'zni avval bazada bor yoki yo'qligini tekshirish agar yo'q bo'lsa saqlanmalar jadvaliga qo'shish
        if ($isWord) {
            return [
                'type' => Phrase::find($isWord->phrase_id)->type,
                'topics' => WordTopic::where('word_id', $isWord->id)->pluck('topic_id')->toArray(),
                'isWord' => true,
                'word_id' => $isWord->id
            ];
        }else if(!$isQuestion) {
            $isSaveWord = SavedWord::where('text', $word)->first();
            if (!$isSaveWord) {
                $source = Source::where('name', 'Bot')->first();
                if ($source) {
                    SavedWord::create([
                        'source_id' => $source->id,
                        'text' => $word,
                    ]);
                }
            }
        };

        // so'zni bolaklab arrayga ajratish
        $kiddingWords = preg_split('/\s+/', $word);
        $isQuestionWord = false;
        foreach ($this->questionWords as $questionWord) {
            if (strpos(strtolower($word), strtolower($questionWord)) !== false) {
                $isQuestionWord = true;
            }
        }

        $phrases = [];
        $topics = [];
        // har bir so'z bolagi uchun matn qidirish
        foreach ($kiddingWords as $kiddingWord) {

            $words = Word::where('text', 'LIKE', '%' . $kiddingWord . '%')
                ->orderBy(DB::raw('CHAR_LENGTH(text)'))
                ->get();

            foreach ($words as $word) {
                $phrases[] = $word->phrase_id;
                $arrs = WordTopic::where('word_id', $word->id)->pluck('topic_id')->toArray();
                foreach ($arrs as $arr) {
                    $topics[] = $arr;
                }
            }
        }
        if (count($phrases) == 0) return false;
        return [
            'type' => $isQuestionWord !== false ? Status::$question : Phrase::find($this->findMostFrequentNumber($phrases))->type,
            'topics' => $this->topThreeMostFrequentNumbers($topics),
            'isWord' => false,
        ];
    }

    public function generateWord($topics, $message)
    {
        $quationPhrase = Phrase::where('type', 'question')
            ->first();

        $words = [];
        foreach ($topics as $topic) {
            $topicWords = Word::join('word_topics', 'words.id', '=', 'word_topics.word_id')
                ->where('topic_id', $topic)
                ->where('words.text','!=', $message)
                ->where('words.phrase_id', '!=', $quationPhrase->id)
                ->get();

            foreach ($topicWords as $word) {

                $isWordArr = true;
                foreach ($words as $wordArr) {
                    if ($word->text == $wordArr->text){
                        $isWordArr = false;
                    }
                }

                if ($isWordArr){
                    $words[] = $word;
                }

            }
        }
        if (count($words) == 0) {
            return [
                'result' => false,
                'message' => "Generatsiya qilinayotgan so'z topilmadi mavzulari:" . json_encode($topics)
            ];
        }
        $randomWords = $this->randomArr($words);
        $resultText = '';
        foreach ($randomWords as $randomWord){
            if ($resultText == ''){
                $resultText = $randomWord->text;
            }else{
                $resultText = $resultText.' ' .$randomWord->text;
            }
        }

        $cleanedText = preg_replace('/\s+/', ' ', $resultText);
        // Matnning boshida va oxirida bo'lgan probellarni olib tashlash
        $cleanedText = trim($cleanedText);

        return [
            'result' => true,
            'text' => $cleanedText
        ];
    }

    public function generateQuationMessage($user = [], $data)
    {
        $questionWord = UserQuestionWord::where('fake_user_id', $user->id)
            ->where('status', Status::$notSaved)
            ->first();

        if ($questionWord){
            $word = Word::find($questionWord->word_id);
            if ($word){
                $savedWord = $this->saveWord($user->id, $word->text);

                return [
                    'status' => true,
                    'comment' => "Savol berish uchun so'z topildi",
                    'message' => $savedWord->message,
                    'role' => Status::$bot,
                    'time' => Carbon::parse($savedWord->created_at)->format('Y-m-d H:i'),
                ];
            }
        }


        return [
            'status' => false,
            'comment' => "Savol topilmadi",
        ];
    }

    // So'roq gapga ajavob bolgan so'zni darak gap sifatida saqlash
    public function savedQuestionWord($user_id, $text)
    {
        $phrase = Phrase::where('type', Status::$tree)->first();

        $quationWord = Chat::where('user_id', $user_id)
            ->where('role', Status::$bot)
            ->orderBy('id', 'desc')
            ->first();

        if (!$quationWord){
            return false;
        }

        $latestChats = Chat::where('user_id', $user_id)
//            ->where('role', Status::$user)
            ->where('id', '>', $quationWord->id)
            ->get();

        // Bu xolatda so'z uchun javob berilgan hisoblanadi
        if (count($latestChats) > 1){
            return false;
        }

        $word = Word::where('text', $quationWord->message)->first();

        if ($word != null && $word->phrase->type == Status::$question){

            $userQuestionWord = UserQuestionWord::where('word_id', $word->id)
                    ->where('fake_user_id', $user_id )
                    ->first();
            $userQuestionWord->status = Status::$saved;
            $userQuestionWord->save();


            $source = Source::where('name', 'Bot')->first();
            $newWord = new Word();
            $newWord->text = $text;
            $newWord->phrase_id = $phrase->id;
            $newWord->source_id = $source->id;
            $newWord->save();


            $topics = WordTopic::where('word_id', $word->id)->get();
            foreach ($topics as $topic) {
                $wordTopic = new WordTopic();
                $wordTopic->word_id = $newWord->id;
                $wordTopic->topic_id = $topic->topic_id;
                $wordTopic->percent = 50;
                $wordTopic->save();
            }
            return true;
        }
        return false;


    }

    public function outgoingWord($user_id, $word_id)
    {

        $outputWord = OutputWord::where('incoming_word_id', $word_id)
            ->where('user_id', '!=', $user_id)
            ->first();

        if ($outputWord) {
            $isChat = Chat::where('user_id', $user_id)
                ->where('output_word_id', $outputWord->id)
                ->first();
            if ($isChat) {
                return [
                    'result' => false
                ];
            }
        }else{
            return [
                'result' => false
            ];
        };

        $outputWord->weight = $outputWord->weight +  1;
        $outputWord->save();

        $saveWord = $this->saveWord($user_id, $isChat->message);

        return [
            'result' => true,
            'text' => $isChat->message,
            'time' => $saveWord->created_at
        ];
    }

    // arraydan random 5ta elementini olish
    public function randomArr($words)
    {
        $count = count($words) > 3 ? 3 : count($words);
        // Massivda kamida 5 ta element bo'lsa
        $numElements = min(count($words), $count);

        // $words ichidan random kalitlarni olish
        $randomKeys = array_rand($words, $numElements);

        // Agar $randomKeys bir elementli bo'lsa, uni massivga aylantirish
        if (!is_array($randomKeys)) {
            $randomKeys = [$randomKeys];
        }

        // Tasodifiy elementlarni olish
        $randomWords = array_map(function ($key) use ($words) {
            return $words[$key];
        }, $randomKeys);

        return $randomWords;

    }

    // array ichidan eng ko'p takrorlanuvchi sonni izlash
    public function findMostFrequentNumber($array)
    {
        // Empty array check
        if (empty($array)) {
            return null;
        }

        $frequency = []; // Array to store frequency of each number

        // Calculate frequency of each number
        foreach ($array as $number) {
            if (!isset($frequency[$number])) {
                $frequency[$number] = 0;
            }
            $frequency[$number]++;
        }

        // Find the number with the highest frequency
        $mostFrequentNumber = null;
        $maxFrequency = 0;

        foreach ($frequency as $number => $count) {
            if ($count > $maxFrequency) {
                $mostFrequentNumber = $number;
                $maxFrequency = $count;
            }
        }

        return $mostFrequentNumber;
    }

    // Array ichidan eng kop takrorlangan 3ta sonni qaytaraldi
    public function topThreeMostFrequentNumbers($array)
    {
        // Arraydagi qiymatlar sonini hisoblash
        $counts = array_count_values($array);

        // Qiymatlar bo'yicha kamayish tartibida saralash
        arsort($counts);

        // Eng ko'p takrorlangan uchta raqamni olish
        return array_slice(array_keys($counts), 0, 3);
    }


}
