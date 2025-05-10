<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Enum\CacheEnum;

class ConfigEmail extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'config_email';

    protected $guarded = [];

    public static function getConfig()
    {
        return cache()->remember(CacheEnum::CONFIG_EMAIL, 3600, function () {
            return self::first()?->toArray();
        });
    }
    
}
