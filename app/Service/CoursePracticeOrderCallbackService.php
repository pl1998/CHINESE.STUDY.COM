<?php

namespace App\Service;



use App\Mail\RecordedCourseOrderMail;
use App\Models\ConfigSite;
use App\Models\CoursePracticeOrder;
use App\Service\Paypal\PaypalCallback;
use Illuminate\Support\Facades\Mail;
use Throwable;


class CoursePracticeOrderCallbackService extends PaypalCallback
{
    public CoursePracticeOrder|null $orderInfo;


    public function errorCallback(): array
    {
        $this->getOrderInfo();
        return [ $this->orderInfo,false];
    }

    /**
     * 处理支付回调
     *
     * @return array
     * @throws Throwable
     */
    public function handle(): array
    {
        // 订单支付成功
        if($this->paypal()) {
            return $this->successCallback();
        } else{
            return $this->errorCallback();

        }
    }

    protected function getOrderInfo()
    {
        $this->orderInfo = CoursePracticeOrder::with('course')->where("order_no",$this->params['order_no'])->first();
        return $this->orderInfo;
    }

    public function successCallback()
    {
        $this->orderInfo = $this->getOrderInfo();
        $this->orderInfo->pay_time = time();
        $this->orderInfo->pay_status = CoursePracticeOrder::PAY_SUCCESS;
        $this->orderInfo->save();

        // 发送邮件给用户
        Mail::to($this->orderInfo->email)
            ->queue(new RecordedCourseOrderMail($this->orderInfo,ConfigSite::getConfig(),false));

        Mail::to(env('SEND_EMAIL'))
            ->queue(new RecordedCourseOrderMail($this->orderInfo,ConfigSite::getConfig(),true));


        return [ $this->orderInfo,true];
    }
}
