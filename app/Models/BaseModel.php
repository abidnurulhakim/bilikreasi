<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BaseModel extends Model
{
	use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function scopeOnlyTrashed($query)
    {
        return $query->whereNotNull($this->getQualifiedDeletedAtColumn());
    }
}
