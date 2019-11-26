<?php

namespace App\Listeners;

use App\Events\TestQueueered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UseQueueCation implements ShouldQueue
{
    /**
     * 任务连接名称。
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * 任务发送到的队列的名称.
     *
     * @var string|null
     */
    public $queue = 'listeners';

    /**
     * 处理任务的延迟时间.
     *
     * @var int
     */
    public $delay = 1;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 这里处理业务逻辑
     *
     * @param  TestQueueered  $event
     * @return void
     */
    public function handle(TestQueueered $event)
    {
        //
        $event->learn->remark = '测试事件监听队列123455';
        $event->learn->save();
    }

    /**
     * 确定监听器是否应加入队列
     * 根据设定的条件 来确定监听器是否加入队列 如果条件成立就加入 否则什么也不做
     *
     * @param  TestQueueered  $event
     * @return bool
     */
    public function shouldQueue(TestQueueered $event)
    {
        return $event->learn->name == '123456';
    }
}
