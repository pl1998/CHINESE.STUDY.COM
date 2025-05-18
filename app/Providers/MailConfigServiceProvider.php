<?php

namespace App\Providers;

use App\Http\Traits\EmailConfig;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    use EmailConfig;

    public function boot()
    {
        $this->setEmailConfig();
    }
}

