<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permission";

    public function user()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
}
