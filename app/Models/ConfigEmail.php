<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ConfigEmail extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'config_email';

    protected $guarded = [];
    
}
