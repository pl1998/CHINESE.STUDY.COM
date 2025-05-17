<?php

namespace App\Service;

use App\Mail\CourseReservationMail;
use App\Models\ConfigSite;
use App\Models\CoursePracticeOrder;
use App\Service\Paypal\PaypalCallback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class CoursePracticeOrderCallbackService extends PaypalCallback
{
    protected Model $orderInfo;

    public function __construct(public array $params){}

    public function errorCallback(){
        $this->getOrderInfo();
        return redirect("/practice-detail/{$this->orderInfo->practice_id}?order_no={$this->orderInfo->order_no}&step=error");
    }

    protected function getOrderInfo()
    {
        $this->orderInfo = CoursePracticeOrder::query()->where("order_no",$this->params['order_no'])->first();
        return $this->orderInfo;
    }

    public function successCallback()
    {
        $orderInfo = $this->getOrderInfo();
        $orderInfo->pay_time = time();
        $orderInfo->pay_status = CoursePracticeOrder::PAY_SUCCESS;
        $orderInfo->save();
        return redirect("/practice-detail/$orderInfo->practice_id?order_no=$orderInfo->order_no&step=success");
    }
}
