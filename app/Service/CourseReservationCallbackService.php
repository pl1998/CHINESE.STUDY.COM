<?php

namespace App\Service;



use App\Mail\CourseReservationMail;
use App\Models\ConfigSite;
use App\Models\CourseReservation;
use App\Service\Paypal\PaypalCallback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class CourseReservationCallbackService extends PaypalCallback
{
    public CourseReservation|null $orderInfo;

    public function errorCallback(){
        $this->getOrderInfo();
        return [ $this->orderInfo,false];
    }

    protected function getOrderInfo()
    {
        $this->orderInfo = CourseReservation::query()->where("order_no",$this->params['order_no'])->first();
        return $this->orderInfo;
    }

      
    /**
     * 处理支付回调
     * 
     * @return array
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

    public function successCallback()
    {
        $this->orderInfo = $this->getOrderInfo();
        $this->orderInfo->pay_time = time();
        $this->orderInfo->pay_status = CourseReservation::PAY_SUCCESS;
        $this->orderInfo->save();
        // 发送邮件
        Mail::to($this->orderInfo->email)
            ->queue(new CourseReservationMail($this->orderInfo,ConfigSite::getConfig()));

        Mail::to(env('SEND_EMAIL'))
            ->queue(new CourseReservationMail($this->orderInfo,ConfigSite::getConfig()));

        return [ $this->orderInfo,true];
    }
}
