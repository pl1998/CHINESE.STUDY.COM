<?php

namespace App\Admin\Traits;

use Carbon\Carbon;
use Illuminate\Support\Fluent;

trait TimeZoneTrait
{
    /**
     * 将时间转换为上海时区显示
     */
    public function formatTimeToShanghai($value)
    {
        return timezone_to_shanghai($value);
    }

    /**
     * 将上海时间转换为UTC时间戳
     */
    public function convertToUtc($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value, 'Asia/Shanghai')->utc()->toDateTimeString();
    }

    /**
     * 处理Grid中的时间显示
     */
    public function handleTimeDisplay($grid)
    {
        // 获取所有时间字段
        $timeFields = ['created_at', 'updated_at', 'start_date', 'end_date', 'deleted_at'];
        
        // 遍历并设置时间显示格式
        foreach ($timeFields as $field) {
            if ($grid->getColumns()->has($field)) {
                $grid->column($field)->display(function ($value) {
                    return timezone_to_shanghai($value);
                });
            }
        }
    }

    /**
     * 处理表单中的时间字段
     */
    public function handleFormTimeFields($form, $fields = ['start_date', 'end_date'])
    {
        foreach ($fields as $field) {
            $form->saving(function ($form) use ($field) {
                $value = $form->input($field);
                if ($value) {
                    $form->input($field, $this->convertToUtc($value));
                }
            });
        }
    }
} 