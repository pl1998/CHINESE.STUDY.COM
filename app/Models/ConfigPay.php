<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ConfigPay extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'config_pay';

    protected $guarded = [];
    
}
