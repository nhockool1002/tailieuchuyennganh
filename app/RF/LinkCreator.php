<?php

namespace App\RF;

use Illuminate\Database\Eloquent\Model;

class LinkCreator extends Model
{
    protected $fillable = [
        'id',
        'name',
        'origin',
        'short_link',
        'created_by',
        'created_at',
        'updated_at',
    ];
    protected $table = "link_creator";
}
