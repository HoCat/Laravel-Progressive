<?php

namespace App\Listeners;

use App\Events\UserLoginered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSystemMessage
{
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
     *
     * @param  UserLoginered  $event
     * @return void
     */
    public function handle(UserLoginered $event)
    {
        // 在事件类中创建了 User ORM 模型实例  现在可以在事件监听类中访问
        echo "<h2 style='text-align: center'>一发入魂 成功击中监听事件</h2>";
        dump($event->user->toArray());
        // 返回false 停止事件传播  禁止事件被其他事件监听类获取
        // return false;
    }
}
