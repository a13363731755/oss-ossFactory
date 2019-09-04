<?php

namespace AliOss\OssFactory\Src;

use Illuminate\Support\ServiceProvider;

class OssServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //发布配置文件到项目的 config 目录中
        $this->publishes([
            __DIR__ . '/../config/oss-config.php' => config_path('oss-config.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('OssServer', function () {
            return new Factory();
        });
        $this->app->bind('AliyunOssServer', function () {
            return new AliyunOssService();
        });
    }
}
