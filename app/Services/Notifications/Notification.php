<?php

namespace App\Services\Notifications;

use App\Models\User;
use App\Services\Notifications\Providers\Contracts\Provider;
use GuzzleHttp\Client;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
/*use Kavenegar\KavenegarApi;*/


class Notification
{

    /**
     * @method sendSms (User $use,string $text)
     * @method sendMail (User $use,Mailable $mailable)
     */
    public function __call($method, $arguments )
    {

        $providerPath = __NAMESPACE__.'\Providers\\'.substr($method,4).'Provider';
        if (!class_exists($providerPath)){
            throw new \Exception('Class does not exist');
        }
        $providerInstance = new $providerPath(...$arguments);
        if (!is_subclass_of($providerInstance,  Provider::class)) throw new \Exception('class provider does not implement');
        return $providerInstance->send();
    }

}
