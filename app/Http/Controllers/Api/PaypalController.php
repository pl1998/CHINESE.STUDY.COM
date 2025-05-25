<?php
namespace App\Http\Controllers\Api;

use App\Enum\OderType;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\CoursePracticeOrder;
use App\Service\CourseReservationCallbackService;
use App\Service\CoursePracticeOrderCallbackService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\CourseReservation;


use App\Http\Traits\EmailConfig;

use Throwable;

class PaypalController extends Controller
{

    use EmailConfig;



    public function pay(Request $request): JsonResponse
    {
        $orderNo = $request->input('order_no');
        $reservation = CourseReservation::where('order_no', $orderNo)->firstOrFail();
        $provider = new PayPalClient;
        try {
            $provider->setApiCredentials(config('paypal'));
        } catch (Exception $e) {
        }
        try {
            $provider->getAccessToken();
        } catch (Throwable $e) {
        }

        try {
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => config('paypal.currency'),
                            "value" => $reservation->pay_price
                        ],
                        "description" => "Course Reservation Order: " . $orderNo
                    ]
                ],
                "application_context" => [
                    "cancel_url" => url("/paypal/cancel?order_no=$orderNo&type=" . OderType::LESSON),
                    "return_url" => url("/paypal/success?order_no=$orderNo&type=" . OderType::LESSON)
                ]
            ]);
        } catch (Throwable $e) {
        }
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
        switch ($request->input('type')) {
            case OderType::LESSON:
       
                [$orderInfo, $bool] = (new CourseReservationCallbackService($request->all()))->handle();
                if($bool){
                    return redirect("/hsk-lesson/{$orderInfo->course_id}?order_no={$orderInfo->order_no}&step=6&course_type={$orderInfo->course_type}");
                } else{
                    return redirect("/hsk-lesson/{$orderInfo->course_id}?order_no={$orderInfo->order_no}&step=error&course_type={$orderInfo->course_type}");
                }
                break;
            case OderType::PRACTICE:
                [$orderInfo, $bool] = (new CoursePracticeOrderCallbackService($request->all()))->handle();
               
                if($bool){
                    return redirect("/practice-detail/{$orderInfo->practice_id}?order_no={$orderInfo->order_no}&step=success");
                } else{
                    return redirect("/practice-detail/{$orderInfo->practice_id}?order_no={$orderInfo->order_no}&step=error");
                }
                break;
            default:
                throw new ApiException("不存在该支付类型");
                break;
        }
    }


    public function cancel(Request $request)
    {
        $orderNo = $request->input('order_no');
        switch ($request->input('type')) {
            case OderType::LESSON:
                $reservation = CourseReservation::where('order_no', $orderNo)->first();
                return redirect("/hsk-lesson/{$reservation->course_id}?order_no={$orderNo}&step=cancel&course_type={$reservation->course_type}");
                break;
            case OderType::PRACTICE:
                $orderInfo = CoursePracticeOrder::where('order_no', $orderNo)->first();
                return redirect("/practice-detail/{$orderInfo->practice_id}?order_no=$orderNo&step=cancel");
                break;
            default:
                throw new ApiException("This type of payment does not exist");
                break;
        }
    }
}
