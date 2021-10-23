<?php

namespace App\Services\Notifications\Providers;

use App\Models\User;
use App\Services\Notifications\Providers\Contracts\Provider;
use Kavenegar;

class SmsProvider implements Provider
{

    private $user;
    private $message;

    public function __construct(User $user , string $message)
    {
        $this->user = $user;
        $this->message= $message;
    }


    public function send()
    {
        try{
            $sender = config('services.sms.auth.sender');
            $message =  $this->message;
            $receptor =$this->user->phone_number;
            $result = Kavenegar::Send($sender,$receptor,$message);

            return $this->getBody($result);

        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            \Log::info('ApiException');
            \Log::info($e);
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            \Log::info('HttpException');
            \Log::info($e);
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }

    protected function getBody($result)
    {
        $response = [];
        $i=0;
        if($result){
            foreach($result as $r){
               $response[$i]["messageid"] = $r->messageid;
                $response[$i]["message"]  = $r->message;
                $response[$i]["status"]  = $r->status;
                $response[$i]["statustext"]  = $r->statustext;
                $response[$i]["sender"]  = $r->sender;
                $response[$i]["receptor"]  = $r->receptor;
                $response[$i]["date"] = $r->date;
                $response[$i]["cost"] = $r->cost;

                $i++;
            }
        }

        return $response;
    }
}
