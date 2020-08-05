<?php


function setConnection($argv)
{
    $url = "http://127.0.0.1:8000/api/";
    if (!isset($argv[1])) {
        print "To open a new voting room: start {name} {title} {number_of_seats}\n";
        print "To vote: vote {name} {title} {vote}\n";
        print "Voting options: [1,2,3,5,8]\n";
        print "To check the result: count {title}\n";
    } elseif ($argv[1] == 'start') {
        if (isset($argv[2], $argv[3], $argv[4])){
            $url = $url.'leader/'.$argv[2].'/'.$argv[3].'/'.$argv[4];
        } else {
            print "For the 'start' option the valid format is: start {name} {title} {number_of_seats}\n";
        }
    } elseif ($argv[1] == 'vote') {
        if (isset($argv[2], $argv[3], $argv[4])) {
            $url = $url . 'player/' . $argv[2] . '/' . $argv[3] . '/' . $argv[4];
        } else {
            print "For the 'vote' option the valid format is: start {name} {title} vote{}\n";
        }
    } elseif ($argv[1] == 'count') {
        if (isset($argv[2])) {
            $url = $url.'count/'.$argv[2];
        }
    } else {
        print "Use the 'start' or 'vote' option\n";
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = json_decode(curl_exec($ch));
    curl_close($ch);
    if ($argv[1] = 'count') {
        print "Final note:";
        foreach ($output[0][0] as $final_note) {
            print $final_note.' ';
        }
        print "\n";
    }
    for ($i = 1; $i <= 5; $i++) {
        print $output[$i][0]." ".$output[$i][2]."\n";
    }

}

setConnection($argv);

