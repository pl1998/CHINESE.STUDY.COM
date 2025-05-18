<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class BaseModel extends Model
{
    /** @var string 时区 */
    public const TIMEZONE = "Asia/Shanghai";

    public function getCreatedAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->setTimezone(self::TIMEZONE)->format('Y-m-d H:i:s') : null;
    }
    public function getUpdatedAtAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->setTimezone(self::TIMEZONE)->format('Y-m-d H:i:s') : null;
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
