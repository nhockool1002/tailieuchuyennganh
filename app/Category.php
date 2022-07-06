<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function post() 
    {
    	return $this->hasMany('App\Post', 'cat_id', 'id');
    }

    public function moderator()
    {
    	return $this->hasMany('App\Moderator', 'cat_id', 'id');
    }

    public function donatecourse() 
    {
        return $this->hasMany('App\DonateListCourse', 'cat_id', 'id');
    }
}
