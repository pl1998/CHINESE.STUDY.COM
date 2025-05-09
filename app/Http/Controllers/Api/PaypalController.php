<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\ConfigPay;
use App\Models\CourseReservation;

class PaypalController extends Controller
{
    public function pay(Request $request)
    {
        $orderNo = $request->input('order_no');
        $reservation = CourseReservation::where('order_no', $orderNo)->firstOrFail();
        // 读取 config_pay 配置
        $config = \App\Models\ConfigPay::first();
        config([
            'paypal.mode'    => $config->paypal_mode,
            'paypal.sandbox.client_id' => $config->paypal_client_id,
            'paypal.sandbox.client_secret' => $config->paypal_secret,
            'paypal.sandbox.app_id' => $config->app_name,
            'paypal.currency' => $config->currency,
            'paypal.http.verify' => env('APP_ENV') == 'pro' ? true: false,
        ]);

      
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config->currency,
                        "value" => $reservation->pay_price
                    ],
                    "description" => "Course Reservation Order: " . $orderNo
                ]
            ],
            "application_context" => [
                "cancel_url" => url("/paypal/cancel?order_no={$orderNo}"),
                "return_url" => url("/paypal/success?order_no={$orderNo}")
            ]
        ]);
        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return response()->json(['paypal_url' => $link['href']]);
                }
            }
        }

        return response()->json(['error' => 'PayPal payment creation failed.'], 500);
    }

    // 支付成功回调
    public function success(Request $request)
    {
        $orderNo = $request->input('order_no');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $token = $request->input('token');
        $response = $provider->capturePaymentOrder($token);

        if ($response['status'] == 'COMPLETED') {
            $reservation = CourseReservation::where('order_no', $orderNo)->first();
            $reservation->status = 'paid';
            $reservation->save();
            // 跳转回前端页面并带上参数
            return redirect("/hsk-lesson?order_no={$orderNo}&step=6");
        }
        return redirect("/hsk-lesson?order_no={$orderNo}&step=error");
    }

    // 支付取消回调
    public function cancel(Request $request)
    {
        $orderNo = $request->input('order_no');
        return redirect("/hsk-lesson?order_no={$orderNo}&step=cancel");
    }
}
