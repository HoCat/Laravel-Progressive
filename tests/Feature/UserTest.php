<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Service\Email\Send;
use App\Constraints\TestUserRepositoryInterface;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    /*
     *  测试用户列表
     * */
    public function testGetUserList()
    {
//        $repository = \Mockery::mock(TestUserRepositoryInterface::class);
//        $repository->shouldReceive('all')->once()->andReturn(['测试通过']);
//        $this->instance(TestUserRepositoryInterface::class, $repository);
        $response = $this->get('/users'); // 请求一个路由

        $response->assertStatus(200); // 断言返回状态
        $response->assertViewHas('hao', 'ceshi');
    }


}
