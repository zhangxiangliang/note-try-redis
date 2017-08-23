<?php

$ip = '192.168.1.101';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);
$channel= 'lyon:channel';

$redis->publish($channel, "来自 {$channel} 频道的推送");
echo "----推送成功----\n";
$redis->close();
