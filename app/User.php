<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function statistic()
    {
        return $this->belongsTo('App\Statistic','statistic_id');
    }

    public function tournaments (){
        return $this->belongsToMany('App\Tournament','user_tournament','user_id','tournament_id');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }

    public function friends (){
        return $this->belongsToMany('App\User','user_has_friends','user_id','friend_id');
    }



}
