<?php

// ini_set('default_socket_timeout', -1);

$ip = '192.168.1.101';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);
$channel= 'lyon:channel';

$redis->subscribe([$channel], function ($redis, $channel, $msg) {
    print_r([
        'redis' => $redis,
        'channel' => $channel,
        'msg' => $msg
    ]);
});

