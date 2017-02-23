<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function statistic(){
        return $this->belongsTo('App\Statistic','statistic_id');
    }
    public function groupCards (){
        return $this->hasMany('App\GroupCard');
    }
}
