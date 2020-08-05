<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['leader_id', 'room_id', 'name', 'vote'];

    public function room()
    {
        return $this->hasOne('App\Room', 'id', 'room_id');
    }

    public function leader()
    {
        return $this->hasOne('App\Leader', 'id', 'leader_id');
    }
}
