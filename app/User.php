<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    // 10.1 add
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        // *Are you following it already?* confirm if already following
        $exist = $this->is_following($userId);
        // *Is it not yourself?* confirming that it is not you
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // do nothing if already following
            return false;
        } else {
            // follow if not following
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // *Are you following it already?* confirming if already following
        $exist = $this->is_following($userId);
        // *Is it not yourself?* confirming that it is not you
        $its_me = $this->id == $userId;
    
    
        if ($exist && !$its_me) {
            // stop following if following
            $this->followings()->detach($userId);
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    // 11.1 add
    
    public function feed_microposts(){
        $follow_user_ids = $this->followings()-> pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////// kadai add ///////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function likes()
    {
        return $this->belongsToMany(Micropost::class, 'user_like', 'user_id', 'like_id')->withTimestamps();
    }

    // public function unlikes()
    // {
    //     return $this->belongsToMany(User::class, 'user_like', 'like_id', 'user_id')->withTimestamps();
    // }
    
    public function like($userId)
    {
        // confirm if already liking
        $exist = $this->is_liking($userId);
        // confirming that it is not you
        // $its_me = $this->id == $userId;
    
        if ($exist) {//|| $its_me) {
            // do nothing if already liking
            return false;
        } else {
            // lik if not liking
            $this->likes()->attach($userId);
            return true;
        }
    }
    
    public function unlike($userId)
    {
        // confirming if already liking
        $exist = $this->is_liking($userId);
        // confirming that it is not you
        // $its_me = $this->id == $userId;
    
    
        if ($exist) {// && !$its_me) {
            // stop liking if liking
            $this->likes()->detach($userId);
            return true;
        } else {
            // do nothing if not liking
            return false;
        }
    }
    
    
    public function is_liking($userId) {
        return $this->likes()->where('like_id', $userId)->exists();
    }
}
