<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostHashTag extends Model
{
    protected $table = "post_hashtag";

    public function post()
    {
    	return $this->belongsTo('App\Post', 'post_id', 'id');
    }

    public function hashtag()
    {
    	return $this->belongsTo('App\HashTag', 'hashtag_id', 'id');
    }
}
