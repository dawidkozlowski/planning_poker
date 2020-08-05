<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    //

    protected $fillable = ['name'];

    public function player()
    {
        return $this->hasMany('App\Player', 'leader_id', 'id');
    }

    public function room()
    {
        return $this->hasMany('App\Room', 'leader_id', 'id');
    }

 }
