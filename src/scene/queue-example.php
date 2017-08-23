<?php

$ip = '192.168.1.101';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);

$queueKey = 'user:queue';

$queueArr = [
    ['uid' => 1, 'name' => 'Job'],
    ['uid' => 2, 'name' => 'Tom'],
    ['uid' => 3, 'name' => 'John'],
];

// 入队列
foreach ($queueArr as $value) {
    $redis->rPush($queueKey, json_encode($value));
}
echo "\n----进入队列成功---\n";

// 查看队列
$data = $redis->lRange($queueKey, 0, -1);
echo "\n----当期队列数据----\n";
print_r($data);

// 出队列
$data = $redis->lPop($queueKey);
echo "\n----出队列数据----\n";
print_r($data);

// 查看队列
$data = $redis->lRange($queueKey, 0, -1);
echo "\n----当期队列数据----\n";
print_r($data);
