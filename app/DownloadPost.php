<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadPost extends Model
{
    protected $table = "download_post";

    public function post()
    {
    	return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
