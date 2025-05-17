<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/CoursePractice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePractice extends Model
{
    protected $table = 'course_practice';
    protected $fillable = ['name', 'link', 'audio', 'cover', 'content', 'level_label', 'zh_name'];

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
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    /**
     *  所有hsk标签
     * @var array
     */
    public const ALL_HSK  =  ['hsk1'=>'hsk1', 'hsk2'=>'hsk2', 'hsk3'=>'hsk3', 'hsk4'=>'hsk4', 'hsk5'=>'hsk5', 'hsk6'=>'hsk6'];

}