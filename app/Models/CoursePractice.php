<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoursePractice extends Model
{
    protected $table = 'course_practice';
    protected $fillable = ['name', 'link', 'audio', 'cover', 'content', 'level_label', 'zh_name', 'price', 'level','origin_price'];

    public function getAudioAttribute($value): string
    {
        if (!str_contains($value, 'http')) {
            return $this->attributes['audio'] = env('APP_URL') . '/storage/' . $value;
        }
        return $value;
    }
    public function getCoverAttribute($value): string
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

    /**
     * 获取课程练习的评论
     * @return HasMany
     */
    public function topics()
    {
        return $this->hasMany(CoursePracticeTopic::class, 'practice_id', 'id')->where('is_show', CoursePracticeTopic::IS_SHOW)->orderBy('created_at', 'desc');
    }

    /** @var string[] 难度等级 */
    public const LEVEL_OPTIONS = [
        1 => 'Beginner ',
        2 => 'Intermediate ',
        3 => 'Advanced ',
        0 => '-'
    ];

}
