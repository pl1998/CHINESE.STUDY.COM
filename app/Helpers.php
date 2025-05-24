<?php

use Carbon\Carbon;

if (!function_exists('null_filter')) {
    function null_filter(array $data)
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}


if(!function_exists('timezone_to_shanghai')) {
    function timezone_to_shanghai($value): string|null
    {

        if(is_numeric($value)) {
            $timestamp = time();

    $date = (new DateTimeImmutable())
    ->setTimestamp($timestamp)
    ->setTimezone(new DateTimeZone('Asia/Shanghai'));
    return $date->format('Y-m-d H:i:s');
        }
     
        return $value ? Carbon::parse($value)->setTimezone('Asia/Shanghai')->format('Y-m-d H:i:s') : null;
    }
}