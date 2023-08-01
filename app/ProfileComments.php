<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileComments extends Model
{
    protected $table = 'profile_comments';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
