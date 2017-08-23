## 基础
* Redis 是一个内存中的 key-value 存储系统。
* 也被叫做非关系型数据库。
* 使用 `SET key value` 设置 key-value 对。
* 使用 `GET key` 获得 value。
* 使用 `DEL key` 删除 key-value 对。
* 使用 `INCR key` 自增 value。
* 使用 `SETNX key` 当 key 不存在时设置 value。
* 使用 `EXPIRE key timer` 设置 key 的存活时间。
* 使用 `TTL key` 查询 key 的剩余存活时间，-1 永生，-2 死亡。

## List
* `RPUSH key value` 往 list 尾部写入值。
* `LPUSH key value` 往 list 头部写入值。
* `LLEN key` 获得 list 长度。
* `LRANGE key start end` 获得范围内的 list。
* `LPOP key` 从 list 头部推出值。
* `RPOP key` 从 list 尾部推出值。

## Set
* `SADD key member` 设置集合值。
* `SREM key member` 删除集合值。
* `SISMEMBER key member` 判断 value 是否存在。
* `SMEMBERS key` 显示 member 集。
* `SUNION key1 key2` 合并集合。

## Sorted Sets
* `ZADD key score member` 设置排序集合值。
* `ZREM key member` 删除集合值。
* `ZRANGE key start end` 获取按 score 排序的集合值。

## Hash
* `HSET key field value` 设置哈希值。
* `HGETALL key` 获得哈希值列表。
* `HMSET key field1 value1` 设置多个哈希值。
* `HGET key field` 获得哈希值。
* `HINCRBY key field value` 增加 value 到原来的哈希值。
