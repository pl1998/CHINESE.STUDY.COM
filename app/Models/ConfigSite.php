<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enum\CacheEnum;
class ConfigSite extends Model
{
    protected $fillable = [
        'instagram_url',
        'tiktok_url',
        'youtube_url',
        'ipone',
        'email'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
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