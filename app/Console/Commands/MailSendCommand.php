<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseReservationMail;
use App\Models\CourseReservation;
use App\Models\ConfigEmail;
use App\Models\ConfigSite;
use Illuminate\Support\Facades\Http;

class MailSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-send-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emailConfig = ConfigEmail::getConfig();
        if(!empty($emailConfig)){
         config([
             'mail.mailers.smtp' => [
                 'transport'  => 'smtp',
                 'host'       => $emailConfig['mail_host'],
                 'port'       => $emailConfig['mail_port'],
                 'encryption' => $emailConfig['mail_encryption'],
                 'username'   => $emailConfig['mail_username'],
                 'password'   => $emailConfig['mail_password'],
             ],
             'mail.from' => [
                 'address' => $emailConfig['mail_from_address'],
                 'name'    => $emailConfig['mail_from_name'],
             ]
         ]);
        }
    
    
        Mail::to('2540463097@qq.com')->send(new CourseReservationMail(CourseReservation::first(),ConfigSite::getConfig()));
    }

    public function paytest ()
    {
   

$response = Http::withHeaders([
    'Accept' => 'application/json',
    'Accept-Language' => 'en_US',
])->withBasicAuth(
    config('paypal.live.client_id'),  // 你的 PayPal Client ID
    config('paypal.live.client_secret')  // 你的 PayPal Secret
)->asForm()->post('https://api.paypal.com/v1/oauth2/token', [
    'grant_type' => 'client_credentials'
]);

// 获取响应数据
$data = $response->json();

// 检查是否成功
if ($response->successful()) {
    // 成功获取 token
    $accessToken = $data['access_token'];
    // 使用 token...
} else {
    // 处理错误
    $error = $data['error'] ?? 'Unknown error';
    $errorDescription = $data['error_description'] ?? 'No description';
    // 记录或处理错误...
}
    }
}
