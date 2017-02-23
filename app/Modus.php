<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modus extends Model
{
    public function tournament()
    {
        return $this->hasMany('App\Tournament');
    }
}
