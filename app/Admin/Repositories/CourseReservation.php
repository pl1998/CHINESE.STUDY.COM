<?php

namespace App\Admin\Repositories;

use App\Models\CourseReservation as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CourseReservation extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
