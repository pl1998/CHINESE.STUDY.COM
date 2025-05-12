<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'cover', 'detail_image', 'content'
    ];  

    public function getCoverAttribute($value)
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['cover'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
    public function getDetailImageAttribute($value)
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['detail_image'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
