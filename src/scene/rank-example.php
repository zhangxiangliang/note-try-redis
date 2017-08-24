<?php

$ip = '192.168.1.129';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);
$rankKey = 'rank:xiaoer';

$rankValue = [
    ['score' => 100, 'user' => ['name' => 'xiaosi']],
    ['score' => 90, 'user' => ['name' => 'xiaoer']],
];

foreach ($rankValue as $rank) {
    $redis->zadd($rankKey, $rank['score'], json_encode($rank['user']));
}

$desc = $redis->zrevrange($rankKey, 0, -1, true);
echo "\n----${rankKey}由大到小排序----\n";
print_r($desc);

$asc  = $redis->zrange($rankKey, 0, -1, true);
echo "\n----${rankKey}由小到大排序----\n";
print_r($asc);

$redis->close();
