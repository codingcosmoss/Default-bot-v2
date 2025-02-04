<?php

namespace App\Telegram\services;

use App\Models\TelegramBot;
use App\Models\TelegramUser;
use App\Models\TelegraphBot;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Log;
use Stringable;

class TelegramService{

    public function registerUser($botUser, $botId){
        $user = TelegramUser::where('telegram_user_id', $botUser->id())->first();
        if (!$user) {
            $newUser = new TelegramUser();
            $newUser->telegram_user_id = $botUser->id();
            $newUser->first_name = $botUser->firstName();
            $newUser->last_name = $botUser->lastName();
            $newUser->username = $botUser->username();
            $newUser->is_premium = $botUser->isPremium();
            $newUser->language_code = $botUser->languageCode();
            $newUser->is_bot = $botUser->isBot();
            $newUser->save();
        }

        // Bu yerda chatni aniqlab olamiz
        $chat = TelegraphChat::where('chat_id', $botUser->id())->first();
        if (!$chat) {
            $chat = new TelegraphChat();
            $chat->name = $botUser->firstName().' '.$botUser->lastName();
            $chat->chat_id = $botUser->id();
            $chat->telegraph_bot_id = $botId;
            $chat->save();
        }

        // Bot klavituralarini joylashtrish
        return Telegraph::chat($chat)->markdown("*Assalomu alaykum ".$botUser->firstName()." botga hush kelibsiz* 👋")
            ->replyKeyboard(ReplyKeyboard::make()
            ->row([
                ReplyButton::make("📑 Barcha testlarni yuklash"),
            ])
        )->send();   
    }


    // Log xabar
    public function log($data)
    {
        Log::info(json_encode($data, JSON_UNESCAPED_UNICODE));
    }


   

}