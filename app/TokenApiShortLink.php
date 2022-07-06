<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenApiShortLink extends Model
{
    protected $table = "token_api_shortlink";

    public function user()
    {
    	return $this->belongsTo('App\TokenApiShortLink', 'user_id', 'id');
    }
}
