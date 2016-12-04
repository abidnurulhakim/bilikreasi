<?php

namespace App\Models;

use App\Models\BaseModel;

class Discussion extends BaseModel
{
    protected $table = 'discussions';
    protected $fillable = [
        'idea_id', 'name'
    ];

    public function participants(){
        return $this->belongsToMany('App\Models\User', 'discussion_participants', 'discussion_id', 'user_id')
                    ->withPivot('last_read', 'join_at', 'unread_count');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'discussion_id');
    }

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }

    public static function search($keyword = '', $filter = [])
    {
        $words = explode(" ", trim($keyword));
        $query = self::query();
        foreach ($words as $word) {
            $query = $query->orWhere('name', 'like', '%'.$word.'%');
        }
        foreach ($filter as $key => $value) {
            if (is_array($value)) {
                $query = $query->whereIn($key, $value);
            } else {
                $query = $query->where($key, $value);
            }    
        }
        return $query;
    }
}
