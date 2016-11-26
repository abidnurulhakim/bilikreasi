<?php

namespace App\Models;

use App\Models\BaseModel;

class Discuss extends BaseModel
{
    protected $table = 'discusses';
    protected $fillable = [
        'idea_id', 'name'
    ];

    public function users()
    {
        $messages = App\Models\Message::where('discuss_id', $this->id)->groupBy('user_id')->get();
        $user_ids = [];
        foreach ($messages as $message) {
        	array_push($user_ids, $message->user_id);
        }
        return App\Models\User::whereIn('id', $user_ids)->get();
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'discuss_id');
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
