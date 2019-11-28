<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\User;
use App\Events\UserLoginered;
use App\Jobs\LearnQueue;
use App\Jobs\LearnQueueOne;
use App\Jobs\LearnQueueTwo;
use App\Jobs\LearnQueueThree;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
//    echo phpinfo();
//    return view('welcome');
    $a = 'USER@asdasd.com';
    dump(filter_var($a, FILTER_VALIDATE_EMAIL));
});

Route::get('/help', function () {
    $res = User::all()->toJson();
    echo $res;
    dump(now()->addMinutes(5));
});

Route::get('/users', 'TestUserController@testGetIndex');

Route::get('/event', function () {
    // 触发一个事件
//    $user = User::find(1);
//    event(new UserLoginered($user));
    $learn = \App\Models\Learn::find(1);
    $learn2 = \App\Models\Learn::find(2);
    event(new \App\Events\LearnRewardered($learn));
    event(new \App\Events\LearnRegressered($learn2));
//    event(new \App\Events\TestQueueered($learn));
});

Route::get('/queue', function () {

    $user1 = User::find(1);
    $user2 = User::find(2);
    $user3 = User::find(3);
    $user4 = User::find(4);
    /*
     * 将任务放入队列
     * delay 方法 可以延时
     */
   // LearnQueue::dispatch($user1)->delay(now()->addMinutes(5));
   // LearnQueueOne::dispatch($user2)->delay(now()->addMinutes(3));
   // LearnQueueTwo::dispatch($user3)->delay(now()->addMinutes(6));
   // LearnQueueThree::dispatch($user4)->delay(now()->addMinutes(2));

    LearnQueueThree::dispatch($user4);
    LearnQueue::dispatch($user1);
    // LearnQueueOne::dispatch($user2);
    // LearnQueueTwo::dispatch($user3);

    // 添加一个立即执行的队列 该队列直接在当前进程中执行
//    LearnQueue::dispatchNow($user1);
    // 添加一个任务链
//    LearnQueue::withChain([
//        new LearnQueueOne($user2),
//        new LearnQueueTwo($user3),
//        new LearnQueueThree($user4),
//    ])->dispatch($user1);
    // 创建不同的队列
    // LearnQueue::dispatch($user1)->onConnection('database')->onQueue('learn');
});

Route::get('/index', 'PostController@index');
Route::post('/posts', 'PostController@store');

