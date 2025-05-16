<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\ConfigPay;
use App\Models\CourseReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseReservationMail;
use App\Http\Traits\EmailConfig;
use App\Models\ConfigSite;
use Illuminate\Support\Facades\Log;
class PaypalController extends Controller
{

    use EmailConfig;

    private function setConfig()
    {
        $config = ConfigPay::first();
        config([
            'paypal.mode'    => $config->paypal_mode,
            'paypal.sandbox.client_id' => $config->paypal_client_id,
            'paypal.sandbox.client_secret' => $config->paypal_secret,
            'paypal.sandbox.app_id' => $config->app_name,
            'paypal.currency' => $config->currency,
            'paypal.http.verify' => env('APP_ENV') == 'pro' ? true: false,
        ]);
        return $config;

    }

    public function pay(Request $request)
    {
        $orderNo = $request->input('order_no');
        $reservation = CourseReservation::where('order_no', $orderNo)->firstOrFail();
        // 读取 config_pay 配置
        $config = $this->setConfig();

      
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
           $this->setConfig();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $token = $request->input('token');
        $response = $provider->capturePaymentOrder($token);
        $reservation = CourseReservation::where('order_no', $orderNo)->first();
       try {
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $reservation->pay_status = 1;
            $reservation->save();
            // 跳转回前端页面并带上参数
            try {
                $this->setEmailConfig();
                Mail::to($reservation->email)
                ->queue(new CourseReservationMail($reservation,ConfigSite::getConfig()));
                Mail::to('chineseteacherelena@outlook.com')
                ->queue(new CourseReservationMail($reservation,ConfigSite::getConfig()));
            } catch (\Exception $e) {
                Log::error('CourseReservationMail send failed: ' . $e->getMessage());
            }
            return redirect("/hsk-lesson/{$reservation->course_id}?order_no={$orderNo}&step=6");
        } else {
            Log::error('Paypal payment failed: ',['response' => $response]);
            $reservation->pay_status = 2;
            $reservation->save();
            return redirect("/hsk-lesson/{$reservation->course_id}?order_no={$orderNo}&step=error");
        }
       } catch (\Exception $e) {
        return redirect("/hsk-lesson/{$reservation->course_id}?order_no={$orderNo}&step=error");
        Log::error('CourseReservation update failed: ' . $e->getMessage());
       }

    }

    // 支付取消回调
    public function cancel(Request $request)
    {
        $orderNo = $request->input('order_no');
        $reservation = CourseReservation::where('order_no', $orderNo)->first();
        return redirect("/hsk-lesson/{$reservation->course_id}?order_no={$orderNo}&step=cancel");
    }
}
