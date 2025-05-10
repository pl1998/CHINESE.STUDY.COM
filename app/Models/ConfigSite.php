<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        return cache()->remember('config_site', 3600, function () {
            return self::first()?->toArray();
        });
    }
}