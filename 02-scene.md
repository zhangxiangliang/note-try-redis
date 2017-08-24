## Redis 简单例子
* 字符串缓存 [传送门](./src/scene/string-cache-example.php)
* 队列 [传送门](./src/scene/queue-example.php)
* 发布订阅
    * 发布者 [传送门](./src/scene/publish-example.php)
    * 订阅者 [传送门](./src/scene/subscribe-example.php)
* 计数器 [传送门](./src/scene/timer-example.php)
* 排行榜 [传送门](./src/scene/rank-example.php)
* 悲观锁 [传送门](./src/scene/pessimistic-lock.php)

## Redis 场景
* 会话缓存(Session Cache)，用来缓存会话，提供数据持久化，如购物车。
* 全页缓存(Full Page Cache) 用来缓存页面，提高页面加载速度，如 wordpress 的 redis 插件。
* 缓存数据
    * 缓存 5000 条数据，当用户请求超过缓存容量时，才把请求发送到数据库。
    * 利用 LREM 来删除文章对应的缓存。
* 用户投票和时间排序
    * 结合 LPUSH 和 LTRIM 命令。
    * 创建一个后台任务用来获取列表和重写排序。
    * ZADD 命令用来按照新的顺序填充生成列表。
* 过期内容处理
    * 使用 unix 时间作为列表关键字，使用来排序。
    * 方便删除过期的条目。
* 好友关系
    * 利用 `set` 数据类型。
    * 命令 `SINTER` 对 `A:follow` 和 `A:follower` 可以得到相互关注。
    * 命令 `SINTER` 对 `A:follow` 和 `B:follow` 可以到共同关注。
    * 命令 `SINTER` 对 `A:follow` 和 `B:follower` A关注的人也关注了B用户。
* 倒排索引
    * `北京` 通过词库转化为 `beijing`。
    * 拆分关键字 `北`, `京`, `b`, `j`, `beijing`。
    * 将关键字作为索引 `index:北`, 存储北京的 `id`。
* 计数
    * 统计 ip 的访问次数，来判断是否需要封 ip。
    * 统计用户注册数 key `REGISTERED_COUNT_TODAY` 配合 `INCR` 命令。
    * 每条微博有点赞数 `weibo:weibo_id`, `hash` 的 filed 为 `like_number`, `comment_number`, `forward_number` 和 `view_number`，使用 `HINCRBY` 来自增。
    * 排行榜使用 `sorted set`，key 使用 `POST_RANK`,当发帖或点赞的时候，利用 `ZINCRBY` 让用户 id 的 score 增加 1。

## 雪崩效应
* 项目中使用了缓存且设置了超时时间。
* 当并发较大，如果没有锁的机制，缓存过期的瞬间。
* 大量并发会穿透缓存直接查询数据库，造成雪崩效应。
