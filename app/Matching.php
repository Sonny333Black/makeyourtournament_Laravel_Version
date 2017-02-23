<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    public function round(){
        return $this->belongsTo('App\Round');
    }
}
