<?php

namespace Tests\Unit;

use App\Service\Email\Send;
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
        $this->assertTrue(true);
    }

    /*
     * 测试邮件
     * */
    public function testSendEmail()
    {
        // 断言是否是send实例
        $this->assertInstanceOf(Send::class, Send::fromString('user@qq.com'));
        // 当传入不正常的值时 断言是否抛出异常
        $this->expectException(\InvalidArgumentException::class);
        Send::fromString('ssss');
        // 断言直接输出对象时是否于传入的参数一致
        $this->assertEquals('user@qq.com', Send::fromString('user@qq.com'));
    }

    /*
     * 测试变量属性
     * */
    public function testVariables()
    {
        $a = true;
        $b = false;
        $c = 100;
        $e = ['123123','23213'];
        $objs = null;

        // 断言变量值 True | False
        $this->assertFalse($b);
        $this->assertTrue($a);

        // 断言变量值是否与期望参数 相等 与 assertNotEquals 相对
        $this->assertEquals(100, $c);
        $this->assertNotEquals(1000, $c);

        // 断言数组是否包含某个值 与 assertNotContains 相对
        $this->assertContains('123123', $e);
        $this->assertNotContains('我没有啊', $e);

        // 断言数组长度是否与期望值相等 与 assertNotCount 相反
        $this->assertCount(2, $e);
        $this->assertNotCount(4, $e);

        // 断言数组是否不为空 与 assertEmpty 相反
        $this->assertNotEmpty($e);

        // 断言变量是否为NULL 与 assertNotNull 相反
        $this->assertNull($objs);

    }

    public function testOutput()
    {
        $this->expectOutputString('达拉');
        echo "达拉";
    }

    public function testOutputRegex()
    {
        $this->expectOutputRegex('/laravel/i');
        echo "laravelsadsadsdsad";
    }

    /*
     *  使用注解对异常进行测试 已经不建议使用
     * @expectedException  \InvalidArgumentException
     */
    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);
        throw new \InvalidArgumentException('无效的参数');
    }
}
