<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class S3Manage extends Model
{
    use SoftDeletes;

    protected $softDelete = true;
    
    protected $table = "s3_manage";
}
