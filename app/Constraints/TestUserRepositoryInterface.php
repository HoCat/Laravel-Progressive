<?php
namespace App\Constraints;
// 测试用户获取数据接口
interface TestUserRepositoryInterface
{
    /**
     *  获取所有用户数据 可以是redis 可以是数据库实现
     * @return array
     * */
    public function all() : array;
}
