<?php

namespace App\Listeners;

use App\Events\TelegramMessage;
use App\Models\CompanySetting;
use App\Models\Patient;
use App\Models\Telegram;
use App\Traits\Action;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTelegramMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TelegramMessage $event): void
    {
        $data = $event->data;
        $type = $event->type;
        $services = $event->services;

        $setting = CompanySetting::first();
        $telegrams = Telegram::all();
        $botToken = "";
        if ($setting){
            $botToken = $setting->bot_token;
        }
        if ($type == 'payment'){
            $patient = Patient::find($data->patient_id);
            foreach ($telegrams as $telegram){

                $message = "To'lov No".$data->id."\n"."\n".
                    "👤 Bemor: ".$patient->first_name.' '.$patient->last_name. "\n".
                    "💰 Miqdori: ".Action::decimal($data->amount).' uzs'."\n".
                    "📅 Sana: ".$data->created_at;

                $url = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$telegram->telegram_id}&text=" . urlencode($message);

                $response = file_get_contents($url);
            }
        }elseif($type == 'treatment'){
            foreach ($telegrams as $telegram){
                $sum = 0;
                $servicesString = '';

                if (count($services) > 0){
                    foreach($services as $key => $service){
                        $sum += $service->result_price;
                        $servicesString .=  '         '.($key+1) .'. '. $service->service_name .' - '. Action::decimal($service->result_price) .' uzs'. "\n";
                    }
                }else{
                    $servicesString = "Xizmatlar mavjud emas";
                }


                $message = "Muolaja No".$data->id."\n".
                    "👤 Bemor: ".$data->patient->first_name.' '.$data->patient->last_name. "\n".
                    "👨‍⚕️ Shifokor: ".$data->user->name."\n".
                    "📑 Xizmatlar: "."\n"."\n".$servicesString."\n".
                    "💰 Umumiy summa: ".Action::decimal($sum).' uzs'."\n".
                    "📅 Sana: ".$data->start.' - '.$data->end ."\n" ;

                $url = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$telegram->telegram_id}&text=" . urlencode($message);

                $response = file_get_contents($url);
            }
        }
    }
}
