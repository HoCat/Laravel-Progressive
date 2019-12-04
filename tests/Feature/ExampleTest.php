<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    /**
     * 测试文件提交
     * 因为CI 没有安装GD扩展 暂时先不测试
     */
//    public function testFileUpload()
//    {
//        Storage::fake('photos'); // 伪造目录
//        $photo = UploadedFile::fake()->image('img.png'); //伪造上传图片
//
//        $this->post('/test/photo', ['photo'=> $photo]);
//
//        Storage::disk('photos')->assertMissing('img.png'); // 断言文件是否上传成功
//    }

    /**
     * 对 Json 测试
     *
     */
    public function testJson()
    {
       $response = $this->json('get', '/test/api');

       $response->assertStatus(200);
       // 断言返回 JSON 数据中是否包含给定数据
       $response->assertJson(['user' => 'nick', 'name' => 'nicker', 'pass' => 123456]);
       // 用于断言返回 JSON 数据中不包含给定键
       $response->assertJsonMissing(['title'=>'does not exists']);
       // 断言给定键值下数据项的个数 前提是该键值下必须为数组
       $response->assertJsonCount(3, 'ceshi');
       // 断言 JSON 数据中是否包含给定片段
       $response->assertJsonFragment(['name' => 'nicker']);
    }


}
