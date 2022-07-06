<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceApiShortLink extends Model
{
    protected $table = "service_api_shortlink";

    public function user()
    {
    	return $this->hasMany('App\ServiceApiShortLink', 'service_shortlink_id', 'id');
    }
}
