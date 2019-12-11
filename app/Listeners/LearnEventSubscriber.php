<?php
namespace App\Listeners;

use App\Models\Learn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LearnEventSubscriber
{
    /*
     * 学习到某个程度奖励事件
     *
     * */
    public function learnReward($event)
    {
        sleep(30);
        $event->learn->score = $event->learn->score + 10; // 奖励10分
        $event->learn->save();
    }

    /*
     * 如果学习退步 减少积分
     *
     */
    public function learnRegress($event)
    {
        $event->learn->score = $event->learn->score - 20;
        $event->learn->save();
    }

    /**
     *  为订阅者注册监听器.
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\LearnRewardered',
            'App\Listeners\LearnEventSubscriber@learnReward'
        );

        $events->listen(
            'App\Events\LearnRegressered',
            'App\Listeners\LearnEventSubscriber@learnRegress'
        );
    }
}
