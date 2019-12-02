<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Constraints\ToDoTaskInterface;
use think\Collection;

class TaskController extends Controller
{
//    protected $service;

    public function __construct()
    {
        // 使用中间件过滤
        $this->middleware('auth:api')->except(['index', 'show']);
//        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(['text'=>'required']);
        $content = $request->text;
        return Task::create([
            'text'        => $content,
            'user_id'     => auth('api')->user()->id,
            'is_completed' => Task::NOT_COMPLETED
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Task  $task
     * @return Collection
     */
    public function update(Task $task)
    {
        // fresh 刷新模型 其实就是再次从数据库中取一次值
        // tap 返回一个集合 由于接口需要 更新后需要返回集合 而不是原生的 true 或 false
        return tap($task)->update(request()->only(['text','is_completed']))->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return response()->json(['message'=>'Task Deleted'],200);
    }
}
