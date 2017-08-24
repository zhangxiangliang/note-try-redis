<?php

class RedisLock {

    public $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function lock($key = '', $expire = 30)
    {
        $is_lock = $this->redis->setnx($key, time() + $expire);
        if(!$is_lock) {
            $lock_time = $this->redis->get($key);
            if(time() > $lock_time) {
                $this->unlock($key);
                $is_lock = $this->redis->setnx($key, time() + $expire);
            }
        }
        return $is_lock ? true : false;
    }

    public function unlock($key = '')
    {
        return $this->redis->del($key);
    }
}

$ip = '192.168.1.129';
$port = 6379;
$lockKey = 'lock:lyon';

$redis = new Redis();
$redis->connect($ip, $port);

$redis = new RedisLock($redis);
if ($redis->lock($lockKey, 10)) {
    echo "\n----Lock Success----\n";
    echo "\n----Doing Someting----\n";
    sleep(5);
    $redis->unlock($lockKey);
    echo "\n----Finish Someting----\n";
    echo "\n----UnLock Success----\n";
} else {
    echo "\n----Resource Is Lock----\n";
}
