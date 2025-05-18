<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseReservation extends BaseModel
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

    public function courseLesson(): BelongsTo
    {
        return $this->belongsTo(CourseLesson::class, 'course_id');
    }
    public const PAY_NOT = 0;
    public const PAY_SUCCESS = 1;
    public const PAY_CANCEL =2;

    public const ZOOM_URL_OK = 1;

    public const NOTICE_NO = 0;
    public const NOTICE_OK = 1;

}
