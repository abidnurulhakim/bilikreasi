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

    public function getLastMessage()
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }

    public static function search($keyword = '', $filter = [])
    {
        $query = self::query();
        if (strlen(trim($keyword)) > 0) {
            $words = preg_split('/\s+/', trim($keyword));
            $query = $query->where(function($q) use ($words) {
                foreach ($words as $word) {
                    $q = $q->orWhere('name', 'like', '%'.$word.'%');
                }
            });
        }
        foreach ($filter as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    $words = preg_split('/\s+/', trim($val));
                    $query = $query->where(function($q) use ($key, $words) {
                        foreach ($words as $word) {
                            $q = $q->orWhere($key, 'like', '%'.$word.'%');
                        }
                    });
                }
            } else {
                $words = preg_split('/\s+/', trim($value));
                $query = $query->where(function($q) use ($key, $words) {
                    foreach ($words as $word) {
                        $q = $q->orWhere($key, 'like', '%'.$word.'%');
                    }
                });
            }    
        }
        return $query;
    }
}
