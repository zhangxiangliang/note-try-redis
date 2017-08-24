<?php
$ip = '192.168.1.129';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);

$redis->flushAll();
