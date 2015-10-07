<?php
// Run this outside of your web root for maximum security

require_once '/web/path/config.php';

$out = array();
foreach($tags as $rack) {
    foreach($rack as $server) {
        if(!preg_match($config['shorten_regex'], $server))
            continue;
        $out[] = $server;
    }
}
echo implode(" ", $out)."\n";
