<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['leader_id', 'title', 'number_of_seats', 'vote_counter'];

    public function player()
    {
        return $this->hasMany('App\Player', 'room_id', 'id');
    }

    public function leader()
    {
        return $this->belongsTo('App\Leader', 'leader_id', 'id');
    }
}
