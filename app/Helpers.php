<?php
if (!function_exists('null_filter')) {
    function null_filter(array $data)
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}
