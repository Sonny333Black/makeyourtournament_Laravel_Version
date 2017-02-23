<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function users (){
        return $this->belongsToMany('App\User','user_tournament','tournament_id','user_id');
    }

    public function modus()
    {
        return $this->belongsTo('App\Modus');
    }

    public function groupCards (){
        return $this->hasMany('App\GroupCard');
    }

    public function matchings(){
        return $this->hasMany('App\Matching');
    }
}
