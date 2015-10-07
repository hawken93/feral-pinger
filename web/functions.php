<?php
/* This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. */

require_once 'config.php';

function preprocess($name) {
    global $config;
    if(preg_match($config['shorten_regex'], $name, $m))
        return $m[1];
    return $name;
}

function draw_server($name, $stats, $dumb=false) {
    $name = preprocess($name);
    $tag = "";
    $text = "";

    if($stats === null){
        if($dumb) {
            $tag  = "class=\"box borderedtinybox\"";
        } else {
            $tag  = "class=\"box borderedbox\"";
        }
    } else {


        if(!$dumb) {
            $tag  = "class=\"box smallbox\" ";
            $sent = intval($stats['tx']);
            $received = intval($stats['rx']);
            $loss = 100 - $received*100./$sent;
            $min = $stats['min'];
            $avg = $stats['avg'];
            $max = $stats['max'];
            $text = "<br />$loss%/$min/$avg/$max";
        } else {
            $tag  = "class=\"box tinybox\" ";
        }
        $tag .= ' style="background-color: '.gradient(intval($stats['loss'])).'"';
    }

    echo "\t<div $tag>$name$text</div>\n";
}

// This hasn't been touched in years (2013?), pretty dusty function...
// Builds on the principle of best compromise...
function gradient($perc){
    // 0   #00ff00
    // 50  #ffff00
    // 100 #ff0000
    /*if($perc==1) $perc=10;
    else if($perc==2) $perc=20;
    else if($perc==3) $perc=30;
    else if($perc>0 && $perc<50) $perc=50;
    else if($perc<90 && $perc>80) $perc=80;
    else if($perc<100 && $perc>90) $perc=90; */

    if($perc<=50)
        $red = 2.55*$perc*2;
    else
        $red = 255;

    if($perc<=50)
        $green = 255;
    else
        $green = (100-$perc)*2*2.55;

    $blue = 80;

    $red = round($red); $green = round($green); $blue = round($blue);

    $red = dechex($red); $red = str_repeat("0",2-strlen($red)).$red;
    $green = dechex($green); $green = str_repeat("0",2-strlen($green)).$green;
    $blue = dechex($blue); $blue = str_repeat("0",2-strlen($blue)).$blue;

    return "#$red$green$blue";
}

// read.. and.. parse.. the file..!
function parse_read_file($fname) {
    $ret = array();
    $lines = explode("\n",trim(file_get_contents($fname),"\n"));
    $ret['start']   = array_shift($lines);
    $ret['stop']    = array_pop($lines);
    $ret['servers'] = parse_fping($lines);
    return $ret;
}

function parse_fping($lines) {
    global $config;
    $servers = array();
    foreach($lines as $l){
        if(!preg_match('/^([a-z0-9\.]+) +: xmt\/rcv\/%loss = ([0-9]+)\/([0-9]+)\/([0-9]+)%(, min\/avg\/max = ([0-9\.]+)\/([0-9\.]+)\/([0-9\.]+))?$/', $l, $m)){
            echo "Poke ".$config['responsible_person']." with this: <pre>".$l."</pre> <br />\n";
            continue;
        }
        $s = $m[1];
        if(isset($m[7])) {
            $servers[$s] = array(
                'tx' => $m[2],
                'rx' => $m[3],
                'loss' => $m[4],
                'min' => $m[6],
                'avg' => $m[7],
                'max' => $m[8],
            );
        } else {
            $servers[$s] = array(
                'tx' => $m[2],
                'rx' => $m[3],
                'loss' => $m[4],
                'min' => '?',
                'avg' => '?',
                'max' => '?',
            );
        }
    }
    return $servers;
}
