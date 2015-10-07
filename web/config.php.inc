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

$config = array(
    // $1 of this function (.*?) is used to fetch the human readable server name,
    // as well as filtering the pingable servers from the other infrastructure
    'shorten_regex' => '/^(.*?)\.example\.com$/',

    // File of the ping statistics
    'cur_file' => '/web/path/example.status',
    // Lock file
    'lock_file' => '/web/path/example.lock',


    'location' => 'City?',
    'route' => 'cogent/amsix/whatever',
    'ISP' => 'Service Provider AS',
    // Yes, it's you!
    'responsible_person' => '',
);

$tags = array(
    "Rack location/Rackname" => array(
        'some-unpingable-switch',
        'pingableserver.example.com',
        'upordown.example.com',
        'www.example.com',
    ),
    "AnotherRack" => array(
        'another.example.com',
        'another-switch',
    ),
);
