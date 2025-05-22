<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseReservationMail;
use App\Models\CourseReservation;
use App\Models\ConfigSite;
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
    
        Mail::to('2540463097@qq.com')->send(new CourseReservationMail(CourseReservation::first(),ConfigSite::getConfig()));


    }
}
