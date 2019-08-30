<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd17f8a598a2d64296fdfc03d55b23d7f
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'OSS\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'OSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/aliyuncs/oss-sdk-php/src/OSS',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd17f8a598a2d64296fdfc03d55b23d7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd17f8a598a2d64296fdfc03d55b23d7f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
