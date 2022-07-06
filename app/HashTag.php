<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashTag extends Model
{
    protected $table = "hashtag_list";

    public function posthashtag()
    {
        return $this->hasMany('App\PostHashTag', 'hashtag_id', 'id');
    }
}
