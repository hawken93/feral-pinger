<?php
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
