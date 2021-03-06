<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

trait Followable
{
    protected $gaurded = [];
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        $this->follows()->toggle($user); 
    }

    public function follows()
    {
        return $this->belongsToMany(
            User::class,'follows',
            'user_id',
            'following_user_id',
            
        );
    }

    public function following(User $user)
    {
        return $this->follows()->where('Following_user_id', $user->id)->exists();
    }
}