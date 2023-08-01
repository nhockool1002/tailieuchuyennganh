<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTpoint extends Model
{
    // use HasFactory;

    protected $fillable = [
        'user_id',
        'tpoint',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addTpoint($points)
    {
        $this->tpoint += $points;
        $this->save();
    }
}
