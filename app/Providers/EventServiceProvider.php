<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\UserLoginered' => [   // 监听用户登录时 推送消息
            'App\Listeners\SendSystemMessage',
            'App\Listeners\TestSendMessage', // 测试事件

        ],
        // 指定监听器启动队列
        'App\Events\TestQueueered' => ['App\Listeners\UseQueueCation'],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // 手动注册一个事件 基于闭包实现 这里注册用户发私信时
        Event::listen('user.letter', function ($foo, $bar) {

        });

        // 通配符监听多个事件
        Event::listen('user.*', function ($eventName, array $data) {
            // 通配符监听器接收事件名作为其第一个参数，并将整个事件数据数组作为其第二个参数
        });
    }

    /**
     * 需要注册的订阅者类。
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\LearnEventSubscriber',
    ];
}
