<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfigEmail;
use Illuminate\Support\Facades\Log;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
}

