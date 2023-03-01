<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function countPosts()
    {
        return $this->post()->count();
    }

    public function page()
    {
        return $this->hasMany('App\Page', 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo('App\Permission', 'role_id', 'id');
    }

    public function link()
    {
        return $his->hasMany('App\Link', 'user_id', 'id');
    }

    public function serviceapishortlink()
    {
        return $this->belongsTo('App\ServiceApiShortLink', 'service_shortlink_id', 'id');
    }

    public function tokenapishortlink()
    {
        return $this->hasOne('App\TokenApiShortLink', 'user_id', 'id');
    }

    public function moderator()
    {
        return $this->hasMany('App\Moderator', 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

}
