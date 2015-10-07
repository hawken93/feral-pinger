<?php
/* This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. */

require_once 'config.php';
require_once 'functions.php';

extract(parse_read_file($config['cur_file']));

?>
<!doctype html>
<html><head>
    <meta http-equiv="refresh" content="60" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
echo "<div class=\"bigbox\">\n";
echo "\t<div class=\"box borderedbox highbox\"><b>Legend</b><br />Server name<br />loss%/min/avg/max<br/>(latency in ms)</div>\n";
echo "\t<div class=\"box borderedbox\"><b>Location</b><br />".$config['location']."</div>\n";
echo "\t<div class=\"box borderedbox\"><b>Route</b><br />".$config['route']."</div>\n";
echo "\t<div class=\"box borderedbox\"><b>ISP</b><br />".$config['ISP']."</div>\n";
echo "\t<div class=\"box borderedbox\"><b>Start</b>: ".$start."</div>\n";
echo "\t<div class=\"box borderedbox\"><b>Stop</b>: ".$stop."</div>\n";
echo "</div>\n";
foreach($tags as $rack=>$info){
    echo "<div class=\"bigbox\">\n";
    echo "\t<div>$rack</div>\n";
    foreach($info as $srv){
        if(isset($servers[$srv])) {
            $stats = $servers[$srv];
            unset($servers[$srv]);
        } else
            $stats = null;

        draw_server($srv, $stats);
    }
    echo "</div>\n";
}
if(count($servers)) {
    echo "<div class=\"bigbox\">\n";
    echo "\t<div>Other</div>\n";
    foreach($servers as $srv=>$stats) {
        draw_server($srv, $stats);
    }
    echo "</div>\n";
}

?></body></html>
