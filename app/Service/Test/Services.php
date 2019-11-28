<?php

namespace App\Service\Test;

class Services
{

    protected  $stack = [];

    public function init()
    {
        $this->stack = ['单元测试','天天学习','laravel','thinkPHP'];
    }

    public function invalidArgument()
    {
        throw new \InvalidArgumentException('无效的参数');
    }


    public function stackContains($value)
    {
        return in_array($value, $this->stack);
    }

    public function getStackSize()
    {
        return count($this->stack);
    }
}
