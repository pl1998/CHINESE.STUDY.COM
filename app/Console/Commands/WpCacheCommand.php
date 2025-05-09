<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class WpCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache';

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
        //
        $this->info("配置缓存成功");
        Artisan::call('config:cache');
        $this->info("路由缓存成功");
        Artisan::call('route:cache');
        $this->info("视图缓存成功");
        Artisan::call('view:cache');
    }
}
