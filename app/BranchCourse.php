<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchCourse extends Model
{
    protected $table = "branch_course";

    public function course() 
    {
        return $this->hasMany('App\DonateListCourse', 'branch_course_id', 'id');
    }
}
