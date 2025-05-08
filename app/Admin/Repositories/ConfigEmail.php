<?php

namespace App\Admin\Repositories;

use App\Models\ConfigEmail as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ConfigEmail extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
