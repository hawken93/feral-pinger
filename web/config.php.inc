<?php
$config = array(
    // $1 of this function (.*?) is used to fetch the human readable server name,
    // as well as filtering the pingable servers from the other infrastructure
    'shorten_regex' => '/^(.*?)\.example\.com$/',

    // File of the ping statistics
    'cur_file' => '/web/path/example.status',


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
