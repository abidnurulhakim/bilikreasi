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
        return App\Models\User::whereIn('id', $user_ids)->get()
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'discuss_id');
    }
}
