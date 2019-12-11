<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Constraints\TestUserRepositoryInterface;
use App\Service\Database\TestDbUser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 注册一个接口实现
        $this->app->bind(TestUserRepositoryInterface::class, TestDbUser::class);
        if ($this->app->environment('local','testing environment name')){
            $this->app->register('\Laravel\Dusk\DuskServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 在所有视图中引入这个变量
//        view()->share('title', '测试啊');
        view()->composer('layouts.header', function($view){
            $view->with(['title' => '测试', 'demo'=> 'demo1']);
        });
        // 自定义一个命令
        Blade::directive('datetime', function($expression) {
            return "<?php echo ($expression); ?>";
        });
    }
}
