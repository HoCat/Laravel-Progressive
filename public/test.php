<?php

interface Log
{
    public function write();
}

class FileLog implements Log
{
    public function write()
    {
//        echo "日志记录成功！";
        $s = 'world';
        printf("日志记录成功 %s", $s);
        // file_put_contents('./logs.log', 'user');
    }
}

class DatabaseLog implements Log
{
    public function write()
    {
       //  $db->insert();
    }
}
class User
{
    protected  $log;

    // 依赖注入 DI
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        echo "登录成功！";
        $this->log->write();
    }
}

//echo $argc;
//printf($argv);

//fwrite(STDOUT,'请输入您的名字：');
//echo '这里是PHP控制台, Hello：'.fgets(STDIN);
// 控制反转 IOC
//$user = new User(new FileLog());
//$user->login();

// 获取User的reflectionClass对象
$reflector = new reflectionClass(User::class);

// 拿到User的构造函数
$constructor = $reflector->getConstructor();

// 拿到User的构造函数的所有依赖参数
$dependencies = $constructor->getParameters();

var_dump($constructor);
var_dump($dependencies);
