<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseReservationMail;
use App\Models\CourseReservation;
use App\Models\ConfigEmail;
class MailSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-send-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
        Mail::to('2540463097@qq.com')->send(new CourseReservationMail(CourseReservation::first()));
    }
}
