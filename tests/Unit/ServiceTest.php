<?php


namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Service\Test\Services;

class ServiceTest extends TestCase
{
    /**
     * @var Services
     *
     */
    protected $service;

    // 初始化
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new Services();
    }

    public function testException()
    {
        // 检测异常
        $this->expectException(\InvalidArgumentException::class);
        $this->service->invalidArgument();
    }

    /**
     *  单元测试依赖关系 如果方法需要依赖别的方法
     */
    public function testInitStack()
    {
        $this->service->init();
        $this->assertEquals(4, $this->service->getStackSize());
        // 这里return 是为了下边的其他测试 保证数据不被污染
        return $this->service;
    }

    /**
     *  表明依赖关系
     * @depends testInitStack
     * @param Services $service
     */
    public function testStackContains(Services $service)
    {
        $contains = $service->stackContains('laravel');
        $this->assertTrue($contains);
    }


    /*
     * 提供测试初始化数据
     */
    public function initData()
    {
        return [
            ['laravel'],
            ['thinkPHP']
        ];
    }

    /**
     * @depends testInitStack
     * @dataProvider  initData
     */
    public function testisInitData()
    {
        // 返回一个包含函数参数列表的数组
        $arguments = func_get_args();
        $service = $arguments[1];
        $value = $arguments[0];
        $this->assertTrue($service->stackContains($value));
    }

}
