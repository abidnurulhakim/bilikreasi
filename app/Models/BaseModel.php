<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
