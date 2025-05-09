<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class WpCacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache:clear';

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
        $this->info("配置缓存清理成功");
        Artisan::call('config:clear');
        $this->info("路由缓存清理成功");
        Artisan::call('route:clear');
        $this->info("视图缓存清理成功");
        Artisan::call('view:clear');
    }
}
