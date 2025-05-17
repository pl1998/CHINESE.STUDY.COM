<?php

namespace App\Service\Paypal;

use App\Enum\OderType;
use App\Exceptions\ApiException;
use App\Models\CoursePracticeOrder;
use App\Models\CourseReservation;
use Illuminate\Database\Eloquent\Model;

class PaypalCallbackService extends PaypalCallback
{
    public function __construct(public array $params){}



    public function errorCallback(){

    }

    public function successCallback()
    {
        $orderInfo = CoursePracticeOrder::query()->where("order_no",$this->params['order_no'])->first();
        $orderInfo->pay_time = time();
        $orderInfo->pay_status = CoursePracticeOrder::PAY_SUCCESS;
        $orderInfo->save();
        // 发送邮件
    }
}
