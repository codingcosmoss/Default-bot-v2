<?php

namespace App\Telegram;

use App\Telegram\services\TelegramService;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler{

    protected array $commands = ['start'];

    // Telegram servis funksiyalari
    public function __construct(protected TelegramService $service)
    {}



    // Botga dastlab kirish
    public function start(){
        $this->service->registerUser($this->message->from(), $this->bot->info()['id']); 
    }

    // Bu funksiya botga yuborilayotgan barcha buyruqlarni nazorat qiladi
    protected function handleUnknownCommand(Stringable $text): void
    {
        if(!in_array($text->value(), $this->commands)){
            $this->reply('Kechirasiz bunday buyruq mavjud emas 🤷‍♂️');
        }
    }

    // Bu funksiya botga yuborilayotgan barcha string xabarlarni nazorat qiladi
    protected function handleChatMessage(Stringable $text): void
    {
        $this->reply($text->value);
    }

}