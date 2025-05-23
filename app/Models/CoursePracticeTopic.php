<?php

namespace App\Models;


class CoursePracticeTopic extends BaseModel
{
    protected $table = 'course_practice_topic';
    
    protected $fillable = [
        'practice_id',
        'name',
        'email',
        'website',
        'content',
        'is_show',
        'topic_id',
    ];

    public const IS_SHOW = 1;

    public function topic()
    {
        return $this->hasOne(CoursePracticeTopic::class, 'topic_id', 'id');
    }
}
