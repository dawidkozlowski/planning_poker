<?php

namespace App\Http\Controllers;

use App\Leader;
use App\Player;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function openRoom($id, $title, $number_of_seats)
    {
        $room = new Room([
            'leader_id' => $id,
            'title' => $title,
            'number_of_seats' => $number_of_seats
        ]);
        $room->save();
    }

}
