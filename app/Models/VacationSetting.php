<?php

namespace App\Models;

use App\Admin\Traits\TimeZoneTrait;
use Illuminate\Database\Eloquent\Model;

class VacationSetting extends Model
{
    use TimeZoneTrait;
    protected $table = "vacation_setting";

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'disabled_dates',
        'time_slots'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'disabled_dates' => 'array',
        'time_slots' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function setStartDateAttribute($value)
    {
    
        $this->attributes['start_date'] = strtotime($this->convertToUtc($value));
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($this->convertToUtc($value));
    }
} 