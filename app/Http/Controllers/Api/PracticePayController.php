<?php
namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Service\Paypal\PayPalService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class PracticePayController extends Controller
{
    /**
     * 创建订单并获取支付地址
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paypal(Request $request) :JsonResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:20',
            'email'       => 'required|email|max:255',
            'phone'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0.01',
            'practice_id' => 'required|integer',
        ]);

        try {
            $result = app()->make(PayPalService::class,['params' => $data])->handle();
            return  response()->json($result);
        }catch (ApiException) {
            return response()->json(['error' => 'PayPal payment creation failed.'], 400);
        }catch (Exception) {
            return response()->json(['error' => 'PayPal errors.'], 500);
        }
    }
}
