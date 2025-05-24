<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;


class CourseReservationDate extends BaseModel
{
	use HasDateTimeFormatter;
    protected $table = 'course_reservation_date';

    protected $primaryKey = 'id';

}
