<?php

namespace App\Http\Traits;
use App\Models\ConfigEmail;
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
}