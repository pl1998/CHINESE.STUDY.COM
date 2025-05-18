<?php

namespace App\Console\Commands;

use App\Mail\CourseReservationJoinNoticeMail;
use App\Models\ConfigSite;
use App\Models\CourseReservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NoticeOfAppointmentCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NoticeOfAppointmentCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '预约会议通知脚本';

    public function handle()
    {
        CourseReservation::with('courseLesson')
            ->where("pay_status",CourseReservation::PAY_SUCCESS)
            ->where("status",CourseReservation::ZOOM_URL_OK)
            ->whereBetween("start_time",[
                strtotime(date('Y-m-d', now()->timestamp)),
                now()->timestamp+(15*60),
            ])->where("is_notice",CourseReservation::NOTICE_NO)
            ->get()
            ->map(function ($order) {
                // 发送邮件
                Mail::to($order->email)
                    ->queue(new CourseReservationJoinNoticeMail($order,ConfigSite::getConfig()));

                Mail::to(env('SEND_EMAIL'))
                    ->queue(new CourseReservationJoinNoticeMail($order,ConfigSite::getConfig()));
                CourseReservation::query()->where('id',$order->id)
                    ->update([
                       'is_notice'=>CourseReservation::NOTICE_OK,
                    ]);
            });
    }
}
