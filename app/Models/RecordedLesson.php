<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordedLesson extends Model
{
    protected $table = 'recorded_lesson';

    protected $fillable = [
        'link',
        'cover',
        'name',
        'description'
    ];

    public function getCoverAttribute($value): string
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['cover'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
} 