<?php

namespace App\Models;


class Subscribe extends BaseModel
{
    protected $fillable = ['email'];
    protected $table = 'subscribes';
    protected $primaryKey = 'id';

}
