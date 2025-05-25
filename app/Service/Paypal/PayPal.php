<?php

namespace App\Service\Paypal;

use App\Enum\OderType;
use App\Exceptions\ApiException;
use App\Http\Traits\EmailConfig;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;
abstract class PayPal
{
    use EmailConfig;

    /** @var string 订单号 */
    public string $orderNo = '';

    /** @var string 订单前缀 */
    public string$orderNoPrefix = "CP";

    /** @var string 订单类型 */

    public string $practice = OderType::PRACTICE;

    /** @var array 请求参数 */
    public array $params = [];

    /**
     * 获取订单号
     *
     * @return string
     */
    public function getOrderNo() :string
    {
        if(!empty($this->orderNo)) return $this->orderNo;
        $this->orderNo =  $this->orderNoPrefix . date('YmdHis') . Str::random(6);
        return  $this->orderNo;
    }

    /**
     * 操作方法
     *
     * @return array
     */
    public function handle() :array
    {
        return [];
    }

    public function getPaypalUrl(): array
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $orderNo =  $this->getOrderNo();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => config('paypal.currency'),
                        "value" => $this->params['price']
                    ],
                    "description" => "Course Practice Order: " . $this->getOrderNo()
                ]
            ],
            "application_context" => [
                "cancel_url" => url("/paypal/cancel?order_no=$orderNo&type=$this->practice"),
                "return_url" => url("/paypal/success?order_no=$orderNo&type=$this->practice")
            ]
        ]);
        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return [
                        'paypal_url' => $link['href'],
                        'order_no'   => $orderNo,
                    ];
                }
            }
        }
        Log::error('Get paypal url errors', ['response' => $response]);
        throw new ApiException('Get paypal url errors');
    }

    /**
     * 创建订单
     *
     * @return int
     */
    protected function createOrder() :int
    {
       return 0;
    }

}
