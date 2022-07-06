<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    public function category()
    {
    	return $this->belongsTo('App\Category', 'cat_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function posthashtag()
    {
        return $this->hasMany('App\PostHashTag', 'post_id', 'id');
    }

    public function downloads()
    {
        return $this->hasOne('App\DownloadPost', 'post_id', 'id');
    }
}
