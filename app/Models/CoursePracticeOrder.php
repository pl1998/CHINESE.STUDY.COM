<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePracticeOrder extends Model
{
    protected $table = 'course_practice_order';

    protected $fillable = [
        'practice_id',
        'name',
        'email',
        'order_no',
        'pay_time',
        'pay_price',
        'pay_status',
    ];

    public const PAY_NOT = 0;
    public const PAY_SUCCESS = 1;
    public const PAY_CANCEL =2;

}
