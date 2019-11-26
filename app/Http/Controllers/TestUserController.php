<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constraints\TestUserRepositoryInterface;

class TestUserController extends Controller
{
    /**
     *  定义一个受保护的属性 在这里控制器不关心底层是数据库或者redis等作为驱动
     * */
    protected $service;

    /**
     *  通过依赖注入 注入一个 TestUserRepositoryInterface 约束接口 实现数据层解耦
     * @param TestUserRepositoryInterface $service
     */
    public function __construct(TestUserRepositoryInterface $service)
    {
        $this->service = $service;
    }


    public function testGetIndex()
    {
        // 通过接口直接调用 all 方法
        $data = $this->service->all();
        return view('users', compact('data'));
    }
}
