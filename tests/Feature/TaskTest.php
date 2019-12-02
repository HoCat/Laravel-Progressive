<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\User;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUserCreateTask()
    {
        $user = User::find(1);
        $task = [
            'text' => 'New task text',
            'user_id'  => $user->id,
        ];
        // 设定用户实例 验证域
        Passport::actingAs($user, ['*']);
        $response = $this->json('POST', 'api/task', $task);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $task);
    }

    /**
     * 测试访客不能创建任务
     */
    public function testGuestCantCreateTask()
    {
        $task = [
            'text' => 'new text',
            'user_id' => 1
        ];

        $response = $this->json('POST', 'api/task', $task);

        $response->assertStatus(401);
        $this->assertDatabaseMissing('tasks', $task);
    }

}
