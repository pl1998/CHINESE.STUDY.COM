<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Enum\CacheEnum;

class ConfigEmail extends BaseModel
{
	use HasDateTimeFormatter;
    protected $table = 'config_email';

    protected $guarded = [];

    public static function getConfig()
    {
        return self::first()?->toArray();
    }


}
