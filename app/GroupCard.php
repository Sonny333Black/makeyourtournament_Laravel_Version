<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupCard extends Model
{
    public function statistic(){
        return $this->belongsTo('App\Statistic','statistic_id');
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament','tournament_id');
    }

    public function team(){
        return $this->belongsTo('App\Team','team_id');
    }
}
