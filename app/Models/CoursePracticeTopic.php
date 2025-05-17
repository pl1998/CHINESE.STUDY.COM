<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePracticeTopic extends Model
{
    protected $table = 'course_practice_topic';

    protected $fillable = [
        'practice_id',
        'name',
        'email',
        'website',
        'content',
        'is_show',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public const IS_SHOW = 1;
}
