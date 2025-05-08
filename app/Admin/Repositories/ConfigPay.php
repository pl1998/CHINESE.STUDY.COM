<?php

namespace App\Admin\Repositories;

use App\Models\ConfigPay as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ConfigPay extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
