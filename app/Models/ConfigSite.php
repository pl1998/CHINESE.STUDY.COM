<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\CacheEnum;
class ConfigSite extends BaseModel
{
    protected $fillable = [
        'instagram_url',
        'tiktok_url',
        'youtube_url',
        'ipone',
        'email'
    ];


    public static function getConfig()
    {
        return cache()->remember(CacheEnum::CONFIG_SITE, 3600, function () {
            if (self::first()) {
                return self::first()?->toArray();
            }
            return [
                'instagram_url' => '',
                'tiktok_url' => '',
                'youtube_url' => '',
                'ipone' => '',
                'email' => '',
            ];
        });
    }
}
