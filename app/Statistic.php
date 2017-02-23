<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function team()
    {
        return $this->hasOne('App\Team');
    }
    public function groupCard()
    {
        return $this->hasOne('App\GroupCard');
    }
}
