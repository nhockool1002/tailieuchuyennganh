<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonateListCourse extends Model
{
    protected $table = "donate_list_course";

    public function branch() 
    {
        return $this->belongsTo('App\BranchCourse', 'branch_course_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }
}
