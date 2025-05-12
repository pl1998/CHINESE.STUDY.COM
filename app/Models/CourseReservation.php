<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConfigEmail;
class CourseReservation extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'course_reservation';

    protected $primaryKey = 'id';

    public static function setEmailConfig()
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

    protected $guarded  = [
      
    ];
}
