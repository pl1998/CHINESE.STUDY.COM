<?php

namespace App\Http\Traits;
use App\Models\ConfigEmail;
use App\Models\ConfigPay;
trait EmailConfig
{
    public function setEmailConfig()
    {
        $emailConfig = ConfigEmail::getConfig();
        if(!empty($emailConfig)){
         config([
             'mail.mailers.smtp' => [
                 'transport'  => 'smtp',
                 'host'       => $emailConfig['mail_host'],
                 'port'       => $emailConfig['mail_port'],
                 'encryption' => $emailConfig['mail_encryption'],
                 'username'   => $emailConfig['mail_username'],
                 'password'   => $emailConfig['mail_password'],
             ],
             'mail.from' => [
                 'address' => $emailConfig['mail_from_address'],
                 'name'    => $emailConfig['mail_from_name'],
             ]
         ]);
        }
    }

    public function setConfig()
    {
        $config = ConfigPay::first();
        config([
            'paypal.mode'    => $config->paypal_mode,
            'paypal.sandbox.client_id' => $config->paypal_client_id,
            'paypal.sandbox.client_secret' => $config->paypal_secret,
            'paypal.sandbox.app_id' => $config->app_name,
            'paypal.currency' => $config->currency,
            'paypal.http.verify' => env('APP_ENV') == 'pro' ? true: false,
        ]);
        return $config;

    }
}
