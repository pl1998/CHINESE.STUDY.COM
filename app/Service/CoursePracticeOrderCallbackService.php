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
    public CoursePracticeOrder|null $orderInfo;

    public function __construct(public array $params){}

    public function errorCallback(){
        $this->getOrderInfo();
        return [ $this->orderInfo,false];
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

    protected function getOrderInfo()
    {
        $this->orderInfo = CoursePracticeOrder::query()->where("order_no",$this->params['order_no'])->first();
        return $this->orderInfo;
    }

    public function successCallback()
    {
        $this->orderInfo = $this->getOrderInfo();
        $this->orderInfo->pay_time = time();
        $this->orderInfo->pay_status = CoursePracticeOrder::PAY_SUCCESS;
        $this->orderInfo->save();
        return [ $this->orderInfo,true];
    }
}
