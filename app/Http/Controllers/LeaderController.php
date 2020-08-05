<?php

namespace App\Http\Controllers;

use App\Leader;
use App\Room;

class LeaderController extends Controller
{
    public function storeWithRoom($name, $title, $number_of_seats)
    {
        $leader = new Leader([
            'name' => $name
        ]);
        $leader->save();
        $id = $leader->id;
        $room = new Room([
            'leader_id' => $id,
            'title' => $title,
            'number_of_seats' => $number_of_seats,
            'vote_counter' => 0
        ]);
        $room->save();
    }

    public function destroy($id)
    {
        $leader = Leader::find($id);
        if (isset($leader)){
            $leader->delete();
        } else {
            return "Team leader with id ".$id." not found";
        }
    }
}
