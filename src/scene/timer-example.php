<?php

$ip = '192.168.1.129';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);

$timerKey = 'timer:lyon';
$redis->set($timerKey, 0);

$redis->incr($timerKey);
$redis->incr($timerKey);
$redis->incr($timerKey);

$strNowCount = $redis->get($timerKey);
echo "\n----当前数量为{$strNowCount}----\n";
