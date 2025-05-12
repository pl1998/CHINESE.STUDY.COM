<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Enum\CacheEnum;
class ConfigPay extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'config_pay';

    protected $guarded = [];

    public static function getConfig()
    {
        return cache()->remember(CacheEnum::CONFIG_PAY, 3600, function () {
            return self::first()?->toArray();
        });
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
