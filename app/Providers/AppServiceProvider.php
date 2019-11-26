<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
