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
use App\User as Auser;
use App\Events\UserLoginered;
use App\Jobs\LearnQueue;
use App\Jobs\LearnQueueOne;
use App\Jobs\LearnQueueTwo;
use App\Jobs\LearnQueueThree;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
//    echo now();
    return view('welcome');
});

Route::get('/help', function () {
    $res = User::all()->toJson();
    factory(User::class)->create();
//    dump( User::all()->fresh());
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
    return $learn;
//    event(new \App\Events\LearnRegressered($learn2));
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

Route::get('/redirect', function(){
    return redirect('http://www.baidu.com');
});
Route::get('/header', function(){
   return response('测试响应头')->header('X-header-One', 'Laraval学院')->header('X-header-Two','Header 头测试');
});

Route::get('/cookie', function(){
    return response('测试COOKIE')->cookie('username', 'hycreeze');
});

Route::get('/session', function(){
    session(['name' => 'hycreeze']);
    session(['pass' => '123456']);
    return response('测试session');
});

Route::prefix('test')->group(function(){
    Route::post('/forms', function(\Illuminate\Http\Request $request){
        $request->validate([
            'title' => 'required|max:200',
            'body' => 'required'
        ]);
        return response('测试表单验证');
    });
    Route::post('/photo', function(\Illuminate\Http\Request $request){
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,bmp,png,gif'
        ]);
        $photo = $request->file('photo');
        $basename = $photo->getClientOriginalName();

        return $photo->storeAs('photos', $basename);
    });
    Route::get('/api', function(\Illuminate\Http\Request $request){
       return [
           'user' => 'nick',
           'name' => 'nicker',
           'pass' => 123456,
           'ceshi' => [
               'wqewqe','21321321','12321'
           ]
       ];
    });
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chats', 'ChatsController@index')->name('chats');

Route::get('/tenxu', 'InterviewController@example')->name('example');

// 路由模型绑定 隐式绑定
Route::get('/task/{task}', function(\App\Models\Task $task){
    dump($task);
});

// 频率限制 该中间件接收两个参数，第一个是次数上限，第二个是指定时间段（单位：分钟）
Route::middleware('throttle:3, 1')->group(function(){
   Route::get('/test_time', function () {
        return 1111;
   });
});

// 使用模型动态设置频率限制
Route::middleware('throttle:rate_limit, 1')->group(function(){
    Route::get('/user', function () {
        // 在 User 模型中设置自定义的 rate_limit 属性值
            return 'user';
    });
    Route::get('/post', function () {
        // 在 User 模型中设置自定义的 rate_limit 属性值
        return 'user';
    });
});

// 获取路由参数
Route::get('once/{id}','HomeController@req');

// 构建上传表单路由
Route::prefix('form')->group(function(){
    Route::get('/','PostController@form');
    Route::post('/submit','PostController@submit');
});

Route::get('/mylogin',  function(){
    return view('layouts.login');
});
// 兜底路由 也就是TP中的Miss路由 属于最后的防线
Route::fallback(function () {
    return response()->view('error');
});
