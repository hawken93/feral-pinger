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


// Run this outside of your web root for maximum security
require_once '/offline/path/config.php';

function addit($server) {
	global $out;
	global $staticdns;
	global $config;

	if(isset($staticdns[$server])) {
		$out[] = $staticdns[$server];
	} else if(preg_match($config['shorten_regex'], $server)) {
		$out[] = $server;
	}
}

$out = array();
foreach($tags as $rack)
	foreach($rack as $server)
		addit($server);
foreach($other as $server)
	addit($server);


echo implode(" ", $out)."\n";
