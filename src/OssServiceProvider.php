<?php

namespace Oss\OssFactory;

use Illuminate\Support\ServiceProvider;

class OssServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //发布配置文件到项目的 config 目录中
        $this->publishes([
            __DIR__ . '/config/oss.php' => config_path('oss.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(Oss::class, function () {
            return new Oss();
        });
    }
}
