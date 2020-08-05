<?php

namespace App\Http\Controllers;

use App\Player;
use App\Room;
use Exception;

class PlayerController extends Controller
{
    public function vote($name, $title, $vote)
    {
        $vote_range = explode(',', env('GRADING_SCALE'));
        if (!in_array($vote, $vote_range)) {
            return "Allowed votes are 1,2,3,5,8";
        }

        try {
            $room = Room::where('title', '=', $title)->firstOrFail();
        } catch (Exception $e) {
            return 'There is no such voting room';
        }

        if ($this->votingEndCheck($room->id)) return 'The maximum number of votes has been reached';
        $player = new Player([
            'leader_id' => $room->leader->id,
            'room_id' => $room->id,
            'name' => $name,
            'vote' => $vote
        ]);
        $player->save();
    }

    public function votingEndCheck($room_id) :bool
    {
        $room = Room::find($room_id);
        $players = Player::where('room_id', '=', $room_id)->get();
        $number_of_players = count($players);
        return $room->number_of_seats == $number_of_players;
    }

    public function voteCounter($title)
    {
        $vote_range = explode(',', env('GRADING_SCALE'));
        $votes = [];
        try {
            $room = Room::where('title', '=', $title)->firstOrFail();
        } catch (Exception $e) {
            return 'There is no such voting room';
        }
        $players = Player::where('room_id', '=', $room->id)->get();
        foreach ($vote_range as $vote_r) {
            if(count($same_vote_players = $players->where('vote', '=', $vote_r))) {
                $names = '';
                foreach ($same_vote_players as $same_vote_player) {
                    $names = $names.' '.$same_vote_player->name;
                }
                array_push($votes, [$vote_r, count($same_vote_players), $names]);
            } else {
                array_push($votes, [$vote_r, 0, '']);
            }
        }

        $votes_set = [];
        foreach ($votes as $vote) $votes_set[$vote[0]] = $vote[1];
        $final_score = max($votes_set);

        $final_scores = [];
        foreach ($votes_set as $key=>$vote_s) {
            if ($vote_s == $final_score) {
                array_push($final_scores, $key);
            }
        }

        array_unshift($votes, [$final_scores]);

        return json_encode($votes);
    }


}
