<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/CoursePractice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePractice extends Model
{
    protected $table = 'course_practice';
    protected $fillable = ['name', 'link', 'audio', 'cover'];

    public function getAudioAttribute($value)
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['audio'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
    public function getCoverAttribute($value)
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['cover'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
}