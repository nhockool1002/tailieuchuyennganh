<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
