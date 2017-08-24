<?php

// 连接
$ip = '192.168.1.129';
$port = 6379;

$redis = new Redis();
$redis->connect($ip, $port);

// 初始化
$success = 0;
$error = 0;
$arr = [];
$ticketKey = 'ticketNumber:xiaoer';
$ticketList = 'ticketList:xiaoer';

$redis->setnx($ticketKey, 5000);

// 抢票
for ($i = 10000; $i >0; $i--) {
    $ticketNumber = $redis->get($ticketKey);

    if($ticketNumber <= 0) {
        echo 'success:' . $success . "\n";
        echo 'error:' . $error . "\n";
        echo $redis->hlen($ticketList) . "\n";
        break ;
    }

    $redis->watch($ticketKey, $ticketList);
    $redis->multi();
    $redis->hSet($ticketList, 'user:' . $ticketNumber, time());
    $redis->set($ticketKey, --$ticketNumber);
    $end = $redis->exec();

    if($end) {
        $success++;
        echo "---- 抢购成功 ----\n";
        echo "---- 剩余数量: {$ticketNumber} ----\n";
        echo "---- 用户列表 ----\n";
        // print_r($redis->hGetAll($ticket['ticketList']));
    } else {
        $error++;
        echo "---- 服务拥挤，请重试 ----\n";
    }
}


