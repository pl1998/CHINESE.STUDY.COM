<?php
namespace App\Service\Paypal;
use App\Enum\OderType;
use App\Exceptions\ApiException;
use App\Http\Traits\EmailConfig;
use App\Models\CoursePracticeOrder;
use Illuminate\Support\Facades\DB;

class PayPalService extends PayPal
{

    use EmailConfig;
    public function __construct(public array $params){}

    /** @var string 订单前缀 */
    public string$orderNoPrefix = "CP";

    /** @var string 订单类型 */
    public string $practice = OderType::PRACTICE;

    /**
     * @return array
     * @throws ApiException
     */
    public function handle() :array
    {
        // 创建订单
        $this->createOrder();
        return $this->getPaypalUrl();
    }
    /**
     * 创建订单
     *
     * @return int
     */
    protected function createOrder() :int
    {
        // 生成订单号
        $orderNo = $this->getOrderNo();
        return DB::table('course_practice_order')->insertGetId([
            'order_no'   => $orderNo,
            'pay_time'   => 0,
            'pay_price'  => $this->params['price'],
            'pay_status' => CoursePracticeOrder::PAY_NOT,
            'created_at' => now(),
            'updated_at' => now(),
            'email'      => $this->params['email'],
            'name'       => $this->params['name'],
            'phone'      => $this->params['phone'],
            'practice_id' => $this->params['practice_id']
        ]);
    }
}
