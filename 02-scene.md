# Redis 常见使用场景

* 简单字符串缓存 [传送门](./src/scene/string-cache-example.php)
* 简答队列 [传送门](./src/scene/queue-example.php)
* 发布订阅
    * 发布者 [传送门](./src/scene/publish-example.php)
    * 订阅者 [传送门](./src/scene/subscribe-example.php)
* 计数器 [传送门](./src/scene/timer-example.php)
* 排行榜 [传送门](./src/scene/rank-example.php)
* 悲观锁 [传送门](./src/scene/pessimistic-lock.php)

## 雪崩效应
* 项目中使用了缓存且设置了超时时间。
* 当并发较大，如果没有锁的机制，缓存过期的瞬间。
* 大量并发会穿透缓存直接查询数据库，造成雪崩效应。
