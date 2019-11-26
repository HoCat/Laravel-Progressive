<?php

namespace App\Listeners;

use App\Events\UserLoginered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TestSendMessage
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
        echo "<h2>这里是第二个监听事件，我是你大哥！<h2>";
    }
}
