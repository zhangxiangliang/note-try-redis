<?php

$ip = '192.168.1.101';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);

// 模拟 SET && GET
$cacheKey = 'lyon:1024';
$cacheValue = ['name' => 'lyon', 'sex' => 'man', 'age' => 30];

$redis->set($cacheKey, json_encode($cacheValue));
$redis->expire($cacheKey, 30);

$data = $redis->get($cacheKey);
$data = json_decode($data, true);

// 模拟 HASH
$cacheKey = 'lyon:1024:homie';
$homie = [
    'boy' => ['xiaoer', 'xiaoesi'],
    'girl' => ['jiangjiang']
];

$redis->hSet($cacheKey, 'boy', json_encode($homie));
$redis->expire($cacheKey, 30);

$data = $redis->hGet($cacheKey, 'boy');
$data = json_decode($data, true);

