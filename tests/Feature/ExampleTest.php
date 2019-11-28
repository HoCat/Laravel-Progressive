<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        // 断言响应状态码是否介意200-300之间
        $response->assertSuccessful();

        $response_not_found = $this->get('/asdsad');
        // 断言响应状态码是否是404
        $response_not_found->assertNotFound();

        // 断言响应状态码是否是403
        // $response->assertForBidden();
    }

    /**
     * 检测返回结果是否存在某个值
     *
     */
    public function testSeeText()
    {
        $response = $this->get('/');
        $response->assertSee('Laravel');
        $response->assertSeeText('Laravel'); //会过滤html 以纯文本方式返回
    }

    /**
     * 测试重定向
     *
     */
    public function testRedirect()
    {
        $response = $this->get('/redirect');
        $response->assertRedirect('http://www.baidu.com');
    }


    /**
     * 测试头信息
     *
     */
    public function testHeader()
    {
        $response = $this->get('/header');
        $response->assertHeader('X-header-One', 'Laraval学院')->assertHeader('X-header-Two', 'Header 头测试');
    }

    /**
     * 测试Cookie
     *
     */
    public function testCookie()
    {
        $response = $this->get('/cookie');
        $response->assertCookie('username','hycreeze');
    }

    /**
     * 测试Session
     *
     */
    public function testSession()
    {
        $response = $this->get('/session');
        // assertSessionHas 是否存在某个值 assertSessionMissing 不存在某个值 也可以用来判断session是否存在
        $response->assertSessionHas('name','hycreeze')->assertSessionHas('pass', '123456')->assertSessionMissing('emptyname');
        // 测试一次性指定包含某些session
        $response->assertSessionHasAll(['name' => 'hycreeze', 'pass' => '123456']);
    }


    /**
     * 测试表单提交
     *
     */
    public function testFromSubmit()
    {
        // 需要暂时禁用 csrf 令牌
        $response = $this->post('/test/forms', ['title' => '测试标题', 'content' => '测试数据']);

        // Laravel 会将验证错误信息存放到名为 errors 的 Session 项中，
        // 所以我们通过 assertSessionHasErrors 和 assertSessionDoesntHaveErrors
        // 断言 Session 中是否包含/不包含对应的验证错误信息。这两个方法都支持一次性断言多个字段。
        $response->assertSessionHasErrors(['body' => 'The body field is required.'])
            ->assertSessionDoesntHaveErrors(['content' => '这里content没有验证 所以肯定不报错']);
    }
}
