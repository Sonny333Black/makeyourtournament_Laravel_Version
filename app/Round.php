<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function matchings(){
        return $this->hasMany('App\Matching','round_id');
    }
}
