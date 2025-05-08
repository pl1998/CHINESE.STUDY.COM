<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CourseReservation extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'course_reservation';

    protected $primaryKey = 'id';

    protected $guarded  = [
      
    ];
}
