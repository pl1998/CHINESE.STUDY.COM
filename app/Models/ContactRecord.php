<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRecord extends Model
{
    protected $fillable = ['name', 'email', 'message'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}